<p align="center">Bank Support Ticket API</p>

## All Endpoints
1. Authentication Endpoints:
- [POST] /user/register
- [POST] /manager/register
- [POST] /itdesk/register
- [POST] /login
- [POST] /logout 

2. Branch Endpoints:
- [POST] /branch/create
- [GET] /branch/list
- [POST] /branch/update/{id}
- [POST] /branch/delete/{id}

3. User Endpoints:
- [GET] /user/list

4. Category Endpoints:
- [POST] /category/create
- [GET] /category/list
- [POST] /category/update/{id}
- [POST] /category/delete/{id}

5. Subcategory Endpoints:
- [POST] /subcategory/create
- [POST] /subcategory/update/{id}
- [POST] /subcategory/delete/{id}

6. Ticket Endpoints:
- [POST] /ticket/create
- [GET] /ticket/list
- [POST] /ticket/update/{id}
- [POST] /ticket/delete/{id}


## Endpoint: user/register, manager/register, or itdesk/register
<p style="font-weight:bold">Method: POST</p>
<p>Description:</p>
<ul>
    <li>This endpoint is used to register a new user, manager, or IT desk user.</li>
</ul>
<p>Request Body Parameters:</p>
<ul>
    <li>name: (Required) The name of the user. It must be a string with a maximum length of 255 characters.</li>
    <li>email: (Required) The email address of the user. It must be a valid email format and unique in the users table, with a maximum length of 255 characters.</li>
    <li>password: (Required) The password of the user. It must be a string with a minimum length of 3 characters.</li>
    <li>branch_id: (Required) The ID of the branch the user belongs to. It must be an integer with a minimum value of 1.</li>
    <li>mobile: (Optional) The mobile number of the user. It must be an integer.</li>
</ul>
<h4>Example Request:</h4>
<pre>
{
    "name": "John Doe",
    "email": "johndoe@example.com",
    "password": "secretpassword",
    "branch_id": 1,
    "mobile": 1234567890
}
</pre>
<h4>Example Response:</h4>
<p style="bold">Success (200 OK):</p>
<pre>
{
    "message": "This is your auth token"
}
</pre>
<p style="bold">Error (4xx, 5xx):</p>
<pre>
{
    "error": "Error message describing the issue."
}
</pre>

## Endpoint: /login
<p style="font-weight:bold">Method: POST</p>
Description:
This endpoint is used for user login.
Request Body Parameters:
email: (Required) The email address of the user. It must be a valid email format with a maximum length of 255 characters.
password: (Required) The password of the user. It must be a string with a minimum length of 3 characters.
<h4>Example Request:</h4>
<pre>
{
    "email": "johndoe@example.com",
    "password": "secretpassword"
}
</pre>
<h4>Example Response:</h4>
<p style="bold">Success (200 OK):</p>
<pre>
{
    "message": "Login Successful",
    "token": "generated_token_here"
}
</pre>
<p style="bold">Error (4xx, 5xx):</p>
<pre>
{
    "error": "Invalid credentials"
}
</pre>

## Endpoint: /branch/create
<p style="font-weight:bold">Method: POST</p>
Description:
This endpoint is used to create a new branch.
Request Body Parameters:
name: (Required) The name of the branch. It must be a string with a maximum length of 255 characters and must be unique among existing branch names.
address: (Optional) The address of the branch. It must be a string with a maximum length of 255 characters.
routing: (Required) The routing number of the branch. It must be an integer.
<h4>Example Request:</h4>
<pre>
{
    "name": "Branch Name",
    "address": "Branch Address",
    "routing": 123456789
}
</pre>
<h4>Example Response:</h4>
<p style="bold">Success (200 OK):</p>
<pre>
{
    "message": "Branch Name branch created successfully"
}
</pre>
<p style="bold">Error (4xx, 5xx):</p>
<pre>
{
    "error": "Error message describing the issue"
}
</pre>

## Endpoint: /branch/list
Method: GET
Description:
This endpoint is used to retrieve a list of all branches along with their associated users and tickets.

<h4>Example Response:</h4>
<p style="bold">Success (200 OK):</p>
<pre>
[
    {
        "id": 1,
        "name": "Branch 1",
        "address": "Address 1",
        "routing": 123456789,
        "created_at": "2022-03-25T12:00:00Z",
        "updated_at": "2022-03-25T12:00:00Z",
        "users": [
            {
                "id": 1,
                "name": "User 1",
                "email": "user1@example.com",
                "created_at": "2022-03-25T12:00:00Z",
                "updated_at": "2022-03-25T12:00:00Z"
            },
            {
                "id": 2,
                "name": "User 2",
                "email": "user2@example.com",
                "created_at": "2022-03-25T12:00:00Z",
                "updated_at": "2022-03-25T12:00:00Z"
            }
        ],
        "ticket": [
            {
                "id": 1,
                "subject": "Ticket 1",
                "details": "Details of Ticket 1",
                "status": "in_progress",
                "created_at": "2022-03-25T12:00:00Z",
                "updated_at": "2022-03-25T12:00:00Z"
            },
            {
                "id": 2,
                "subject": "Ticket 2",
                "details": "Details of Ticket 2",
                "status": "approved",
                "created_at": "2022-03-25T12:00:00Z",
                "updated_at": "2022-03-25T12:00:00Z"
            }
        ]
    },
    {
        "id": 2,
        "name": "Branch 2",
        "address": "Address 2",
        "routing": 987654321,
        "created_at": "2022-03-25T12:00:00Z",
        "updated_at": "2022-03-25T12:00:00Z",
        "users": [],
        "ticket": []
    }
]
</pre>
<p style="bold">Error (4xx, 5xx):</p>
<pre>
{
    "error": "Error message describing the issue"
}
</pre>

## Endpoint: /branch/update/{id}
<p style="font-weight:bold">Method: POST</p>
Description:
This endpoint is used to update an existing branch with the specified ID.

Path Parameters:
id: (Required) The ID of the branch to be updated.
Request Body Parameters:
name: (Optional) The updated name of the branch. It must be a string with a maximum length of 255 characters and must be unique among existing branch names.
address: (Optional) The updated address of the branch. It must be a string with a maximum length of 255 characters.
routing: (Optional) The updated routing number of the branch. It must be an integer.
<h4>Example Request:</h4>
<pre>
{
    "name": "Updated Branch Name",
    "address": "Updated Branch Address",
    "routing": 987654321
}
</pre>
<h4>Example Response:</h4>
<p style="bold">Success (200 OK):</p>
<pre>
{
    "message": "Updated Branch Name updated"
}
</pre>
<p style="bold">Error (4xx, 5xx):</p>
<pre>
{
    "error": "Error message describing the issue"
}
</pre>

## Endpoint: /branch/delete/{id}
<p style="font-weight:bold">Method: POST</p>
Description:
This endpoint is used to delete an existing branch with the specified ID.

Path Parameters:
id: (Required) The ID of the branch to be deleted.
<h4>Example Response:</h4>
<p style="bold">Success (200 OK):</p>
<pre>
{
    "message": "Branch Name deleted"
}
</pre>
<p style="bold">Error (4xx, 5xx):</p>
<pre>
{
    "error": "Error message describing the issue"
}
</pre>