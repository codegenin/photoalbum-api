# Sample Photo Album with API. Coded in Laravel

### What is this?

This is a sample photo album application with mobile API. I created this as a sample API for an Ionic Framework training.

### Installation

1. `git clone` and `composer install`
2. Copy `.env.example` to `.env`
3. Create a blank database
3. Edit `.env` file to point to your database
4. Run `php artisan key:generate`
5. Run `php artisan migrate`. It will also create a test user.

### Unauthenticated Endpoints

<table>
    <tr>
        <th>URL</th>
        <th>Parameters</th>
        <th>Returns</th>
        <th>Explanation</th>
    </tr>
    <tr>
        <td>GET /api/v1</td>
        <td></td>
        <td>Hi there!</td>
        <td>Just to show that the API is working</td>
    </tr>
    <tr>
        <td>POST /api/v1/login</td>
        <td>email, password</td>
        <td>JWT Token</td>
        <td>You will need to use this token for authenticated requests</td>
    </tr>
    <tr>
        <td>POST /api/v1/register</td>
        <td>email, password, name</td>
        <td>JWT Token</td>
        <td>You will need to use this token for authenticated requests</td>
    </tr>
</table>

### Authenticated Endpoints

To use authenticated endpoints, user must login / register using the API above. The API will return a token string. To use the token, an `Authorization` header  with `Bearer token` content must be sent together with each request.


<table>
    <tr>
        <th>URL</th>
        <th>Parameters</th>
        <th>Returns</th>
        <th>Explanation</th>
    </tr>
    <tr>
        <td>GET /api/v1/profile</td>
        <td></td>
        <td>User Object</td>
        <td></td>
    </tr>
    <tr>
        <td>GET /api/v1/albums</td>
        <td></td>
        <td>Array of Album Objects</td>
        <td>Gets a list of users' private and public albums together with other users' public albums</td>
    </tr>
    <tr>
        <td>GET /api/v1/albums/{id}</td>
        <td></td>
        <td>Album Object</td>
        <td>Get an album details by id</td>
    </tr>
    <tr>
        <td>POST /api/v1/albums</td>
        <td>name, cover_picture_id (optional), is_public (optional)</td>
        <td>Album Object</td>
        <td>Create a new album</td>
    </tr>
    <tr>
        <td>PUT /api/v1/albums/{id}</td>
        <td>name (optional), cover_picture_id (optional), is_public (optional)</td>
        <td>Album Object</td>
        <td>Update and existing album by id</td>
    </tr>
    <tr>
        <td>DELETE /api/v1/albums/{id}</td>
        <td></td>
        <td></td>
        <td>Delete and existing album by id</td>
    </tr>
</table>