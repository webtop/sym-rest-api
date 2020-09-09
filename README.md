# Symfony REST API Demo
Simple demo REST API

This code is incomplete. This is my first time using Symfony for a project, though I have used some Symfony components before in other projects.

I included a Makefile to more easily manage the starting of the project.
- Check out the code
- Navigate to the build folder 
- Run "make start" from a terminal

After the containers are built, Composer will run and ansure everything is up-to-date. You should then see an output that shows 2 containers running.

To stop the containers, navigate to the build folder and issue "make stop". You can view the build/Makefile for additional commands.

# Missed items
I was not able to get to the API endpoint to edit a joke. I was also not able to generate the Swagger documentation. 

# Use
The API can be reached however, from Postman or other API client at http://localhost/api/v1/joke with the following endpoints:
- [GET]    /list/{page}/{perPage} (defaults to page 1, perPage 5) -- Lists jokes
- [GET]    /fetch/{id} -- Fetches a joke by ID
- [GET]    /random -- Fetches a random joke
- [POST]   / -- Creates a new joke (requires a JSON packet with "title"(max 40) and "body"(max 1200)
- [DELETE] /{id} -- Deletes a joke by id

Missing:
- [PUT]    /{id} -- Edit an existing joke
