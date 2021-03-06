# Installation
Run the following to clone this repo:

    git clone https://github.com/kliker02/ads-api.git 

Change dir: 

    cd ads-api
    
Install dependencies: 

    composer install

Build and configure docker image:

    docker build -t test-task .
    docker run -i -t -p "8080:80" -p "9906:3306" -v %cd%:/app -v %cd%/mysql:/var/lib/mysql test-task
    
Optional(for connecting out of container):

    docker exec Container_ID mysql -uroot -e "ALTER USER 'admin' IDENTIFIED BY 'admin';"


# Routes

**1.Adding advertisement**
```http request
POST /ads HTTP/1.1
Host: localhost
Content-Type: application/x-www-form-urlencoded

text=Advertisement1&price=300&limit=1000&banner=https://linktoimage.png
```

| Field| Description  | Type  |
|---|---|---|
| text | Ad title | string |
| price | Ad price | float |
| limit | Limit views | int |
| banner | Link to image | string |


**2.Get advertisement**

```http request
GET /ads/relevant HTTP/1.1
Host: localhost

```

**3.Edit advertisement**
```http request
POST /ads/1234 HTTP/1.1
Host: localhost
Content-Type: application/x-www-form-urlencoded

text=Advertisement123&price=450&limit=1200&banner=https://linktoimage.png
```