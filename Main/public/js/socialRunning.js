import { Client, createRequest, cacheExchange, fetchExchange, gql } from '@urql/core';

const client = new Client({
    url: "http://localhost:5000",
    exchanges: [cacheExchange, fetchExchange]
});

// Define your GraphQL query
const query = gql`
    query {
        get_user_by_id(id: 1) {
            userName
            favRunningSite
            age
            runningGroup {
                runningGroupName
                id
            }
        }
    }
`;

// Execute the query using the client
client.query(query).toPromise().then((result) => {
    if (result.error) {
        console.error('Error:', result.error);
    } else {
        console.log('Data:', result.data);
    }
});
