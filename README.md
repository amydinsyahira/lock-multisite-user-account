## Lock Multisite User Account ##  
- Contributors: amydin
- Tags: multisite, rest api, lock account, wordpress user accounts, lock user, users, block user, disable user
- Requires at least: 4.3
- Tested up to: 6.3.1
- Stable tag: 1.0.0
- License: GPLv2 or later
- License URI: https://www.gnu.org/licenses/gpl-2.0.html

## Description ##  

Lock Multisite User Account plugin provides functionality to lock WordPress registered user accounts with REST API.

Install and activate plugin, go to Users page, select users you want to lock/unlock and then select the action from Bulk Actions drop down or you can use [REST API](#authentication).

Take a look at our [github page](https://github.com/amydinsyahira/lock-multisite-user-account/) for the REST API documentation.

## Installation ##  

You can install this using all the usual methods. The only difference is that this plugin **must be network activated (multisite)**.  

## Upgrade Notice ##

Upgrades are pushed through WordPress.org.

## Screenshots ##

- [Screenshot 1](https://raw.githubusercontent.com/amydinsyahira/lock-multisite-user-account/main/assets/screenshot-1.png)
- [Screenshot 2](https://raw.githubusercontent.com/amydinsyahira/lock-multisite-user-account/main/assets/screenshot-2.png)
- [Screenshot 3](https://raw.githubusercontent.com/amydinsyahira/lock-multisite-user-account/main/assets/screenshot-3.png)
- [Screenshot 4](https://raw.githubusercontent.com/amydinsyahira/lock-multisite-user-account/main/assets/screenshot-4.png)
- [Screenshot 5](https://raw.githubusercontent.com/amydinsyahira/lock-multisite-user-account/main/assets/screenshot-5.png)

## Changelog ##

### 1.0.0 ###
* Bulk actions to lock / unlock user in multisite with REST API

## Authentication ##

All endpoints require authentication from an existing WordPress user.
We suggest using JWT through something like [simple-jwt-login](https://wordpress.org/plugins/simple-jwt-login/).

### Lock User(s) ###
- **Endpoint:** /wp-json/wp/v2/users/lock
- **Method:** POST
- **Args:** ["user_id"]
- **Examples:**
```
curl -X POST \
  'https://your-wordpress-domain/wp-json/wp/v2/users/lock' \
  --header 'Authorization: Bearer JWT_TOKEN' \
  --header 'Content-Type: application/json' \
  --data-raw '{
  "user_id": [
    1, 2, 5
  ]
}'
``` 

### Unlock User(s) ###
- **Endpoint:** /wp-json/wp/v2/users/lock
- **Method:** DELETE
- **Args:** ["user_id"]
- **Examples:**
```
curl -X DELETE \
  'https://your-wordpress-domain/wp-json/wp/v2/users/lock' \
  --header 'Authorization: Bearer JWT_TOKEN' \
  --header 'Content-Type: application/json' \
  --data-raw '{
  "user_id": [
    1, 2, 5
  ]
}'
```
