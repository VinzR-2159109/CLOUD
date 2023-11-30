from graphene import *
from flask import Flask
from graphql_server.flask import GraphQLView
import pandas as pd

dfUsers = pd.read_excel("users.xlsx")
dfRunningGroups = pd.read_excel("runningGroups.xlsx")

class RunningGroup(ObjectType):
    runningGroupName = Field(String)
    id = Field(Int)
    users = List(lambda: User)

    def resolve_users(parent, info):
        return dfUsers[dfUsers["runningGroupId"] == parent.get("id")].to_dict(orient="records")

class User(ObjectType):
    userName = Field(String)
    favRunningSite = Field(String)
    runningGroup = Field(RunningGroup)
    age = Field(Int)

    def resolve_runningGroup(parent, info):
        return dfRunningGroups[dfRunningGroups["id"] == parent.get("runningGroupId")].to_dict(orient="records")[0]

class NewUserInput(InputObjectType):
    userName = String(required=True)
    favRunningSite = String(required=True)
    age = Int(required=True)
    runningGroupId = Int(required=True)

class CreateUser(Mutation):
    class Arguments:
        user_data = NewUserInput(required=True)

    success = String()
    user = Field(lambda: User)

    def mutate(self, info, user_data):
        new_user = {
            "userName": user_data.userName,
            "favRunningSite": user_data.favRunningSite,
            "age": user_data.age,
            "runningGroupId": user_data.runningGroupId  
        }
        global dfUsers
        new_user["id"] = len(dfUsers) + 1
        dfUsers = pd.concat([dfUsers, pd.DataFrame([new_user])], ignore_index=True)

        return CreateUser(success="User created successfully", user=new_user)

class Mutation(ObjectType):
    create_user = CreateUser.Field()

class Query(ObjectType):
    get_user_by_id = Field(User, id=ID(required=True))
    get_user_by_username = Field(User, username=String(required=True))

    def resolve_get_user_by_id(parent, info, id):
        users = dfUsers[dfUsers["id"] == int(id)]
        return users.iloc[0]

    def resolve_get_user_by_username(parent, info, username):
        users = dfUsers[dfUsers["userName"] == username]
        return users.iloc[0]
        
schema = Schema(query=Query, mutation=Mutation)
myWebApp = Flask("My App")

myWebApp.add_url_rule('/graphql', view_func=GraphQLView.as_view('graphql', schema=schema, graphiql=True))
