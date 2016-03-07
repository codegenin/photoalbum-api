# Sample Photo Album with API. Coded in Laravel

## What is this?

This is a sample photo album application with mobile API. I created this as a sample API for an Ionic Framework training.

## Installation

1. `git clone` and `composer install`
2. Copy `.env.example` to `.env`
3. Create a blank database
3. Edit `.env` file to point to your database
4. Run `php artisan key:generate`
5. Run `php artisan migrate`. It will also create a test user.


## Usage

To tinker with the API, I strongly recommend [postman](https://www.getpostman.com/). The API endpoints are to be used as per below.


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
        <td>GET /api/v1/sync?last_sync={timestamp}</td>
        <td></td>
        <td>Array of objects changed sync last sync</td>
        <td>timestamp is formatted in Unix Timestamp e.g.: 1457380303</td>
    </tr>
    <tr>
        <th colspan="4">ALBUMS</th>
    </tr>
    <tr>
        <td>GET /api/v1/albums</td>
        <td></td>
        <td>Array of Album Objects</td>
        <td>Gets a list of users' private and public albums together with other users' public albums</td>
    </tr>
    <tr>
        <td>GET /api/v1/albums/{album_id}</td>
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
        <td>PUT /api/v1/albums/{album_id}</td>
        <td>name (optional), cover_picture_id (optional), is_public (optional)</td>
        <td>Album Object</td>
        <td>Update an existing album by id</td>
    </tr>
    <tr>
        <td>DELETE /api/v1/albums/{album_id}</td>
        <td></td>
        <td></td>
        <td>Delete an existing album by id</td>
    </tr>
    <tr>
        <th colspan="4">PICTURES</th>
    </tr>
    <tr>
        <td>GET /api/v1/albums/{album_id}/pictures</td>
        <td></td>
        <td>Array of Picture Objects</td>
        <td>Gets a list of the album's picture</td>
    </tr>
    <tr>
        <td>GET /api/v1/albums/{album_id}/pictures/{picture_id}</td>
        <td></td>
        <td>Picture Object</td>
        <td>Get a picture details by id</td>
    </tr>
    <tr>
        <td>POST /api/v1/albums/{album_id}/pictures</td>
        <td>name, base64img, description (optional), lat (optional), lng (optional)</td>
        <td>Picture Object</td>
        <td>Create a new picture. <br/><b>Picture has to be encoded in Base64 hash before uploaded</b></td>
    </tr>
    <tr>
        <td>PUT /api/v1/albums/{album_id}/pictures/{picture_id}</td>
        <td>name (optional), description (optional), lat (optional), lng (optional)</td>
        <td>Picture Object</td>
        <td>Update an existing picture by id</td>
    </tr>
    <tr>
        <td>DELETE /api/v1/albums/{album_id}/pictures/{picture_id}</td>
        <td></td>
        <td></td>
        <td>Delete an existing picture by id</td>
    </tr>
</table>


## Sample Data


**User Object**


```json
{
  "id": 1,
  "name": "Zulfa Juniadi",
  "email": "zulfajuniadi@gmail.com",
  "created_at": "2016-03-06 21:14:44",
  "updated_at": "2016-03-06 21:14:44"
}
```

**Album Object**


```json
{
  "id": 1,
  "user_id": 1,
  "name": "Test Album",
  "is_public": 1,
  "cover_picture_id": 1,
  "created_at": "2016-03-06 21:16:14",
  "updated_at": "2016-03-07 18:46:14",
  "cover_picture": {
    "id": 1,
    "album_id": 1,
    "name": "Ouch",
    "description": "Tak ingat kenapa jari ni sakit...",
    "size": 234428,
    "url": "http://photoalbum.dev/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S.jpg",
    "thumb_url": "http://photoalbum.dev/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S_thumb.jpg",
    "file_name": "21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S.jpg",
    "file_path": "/private/var/www/photoalbum.dev/public/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S.jpg",
    "thumb_path": "/private/var/www/photoalbum.dev/public/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S_thumb.jpg",
    "lat": "3.15",
    "lng": "101.7167",
    "created_at": "2016-03-07 18:46:14",
    "updated_at": "2016-03-07 18:59:57"
  },
  "user": {
    "id": 1,
    "name": "Zulfa Juniadi",
    "email": "zulfajuniadi@gmail.com",
    "created_at": "2016-03-06 21:14:44",
    "updated_at": "2016-03-06 21:14:44"
  }
}
```

**Picture Object**


```json
{
  "id": 1,
  "album_id": 1,
  "name": "Ouch",
  "description": "Tak ingat kenapa jari ni sakit...",
  "size": 234428,
  "url": "http://photoalbum.dev/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S.jpg",
  "thumb_url": "http://photoalbum.dev/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S_thumb.jpg",
  "file_name": "21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S.jpg",
  "file_path": "/private/var/www/photoalbum.dev/public/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S.jpg",
  "thumb_path": "/private/var/www/photoalbum.dev/public/uploads/20160307/21fTZqpiH2sqXMoEbsgSRerE6dI9waDnGPOsD5jegO7lJf2S_thumb.jpg",
  "lat": "3.15",
  "lng": "101.7167",
  "created_at": "2016-03-07 18:46:14",
  "updated_at": "2016-03-07 18:59:57"
}
```


## License


The MIT License (MIT)
Copyright (c) 2016 Zulfa Juniadi bin Zulkifli <zulfajuniadi@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.