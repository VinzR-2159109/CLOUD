from graphene import *
from flask import Flask
from graphql_server.flask import GraphQLView
import pandas as pd

dfUsers = pd.read_excel("users.xlsx")

class User(ObjectType):
    userName = Field(String)
    favRunningSite = Field(String)
    runningGroupId = Field(Int)

class Query(ObjectType):
    get_user_by_id = Field(User, id=ID(required=True))
    get_user_by_username = Field(User, username=String(required=True))
    get_users_by_fav_running_site = List(User, fav_running_site=String(required=True))
    get_users_in_group = List(User, running_group_id=Int(required=True))

    def resolve_get_user_by_id(parent, info, id):
        users = dfUsers[dfUsers["id"] == int(id)]
        return users.iloc[0]
    def resolve_get_user_by_username(parent, info, username):
        users = dfUsers[dfUsers["userName"] == username]
        return users.iloc[0]

    def resolve_get_users_by_fav_running_site(parent, info, fav_running_site):
        users = dfUsers[dfUsers["favRunningSite"] == fav_running_site]
        return users.to_dict(orient="records")

    def resolve_get_users_in_group(parent, info, running_group_id):
        users = dfUsers[dfUsers["runningGroupId"] == running_group_id]
        return users.to_dict(orient="records")
    
schema = Schema(query=Query)
myWebApp = Flask("My App")
myWebApp.add_url_rule('/graphql', view_func=GraphQLView.as_view('graphql', schema=schema, graphiql=True))
