# Laravel Test

### Quick details
- I worked on both minimum and bonus requirements.
- Since the task wasn't mentioning anything specific about the authentication, I only validate the presence of the `api_token` URL parameter using a middleware.
- Each time an e-mail is sent, I use the `Illuminate\Mail\Events\MessageSent` event to save the e-mail in the database, so it can then be listed when accessing the `/api/list` endpoint. 
  I believe this is the best aproach to do the saving, because otherwise some inconsistencies might appear. 
  The problem though is that there's no easy way to fetch the attachments from a sent message. 
  That's why I only saved the attachment name for the moment. 

### Example payload for the sending endpoint:

```json
{
    "messages": [
        {
            "subject": "Plain text e-mail example",
            "body": "Just a plain text message.",
            "recipient": "one@example.com"
        },
        {
            "subject": "HTML e-mail example",
            "body": "<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n<meta charset=\"UTF-8\">\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<title>HTML e-mail example<\/title>\r\n<\/head>\r\n<body>\r\n<p><b>HTML<\/b> e-mail example<\/p>\r\n<\/body>\r\n<\/html>",
            "recipient": "two@example.com"
        },
        {
            "subject": "Plain text e-mail with attachment example",
            "body": "You should see a 1x1 pixels PNG image attached.",
            "recipient": "three@example.com",
            "attachments": [
                {
                    "encoded_content": "iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAABhGlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw0AcxV/TSkVaHOwgIpihOogFURFHrUIRKpRaoVUHk0u/oElDkuLiKLgWHPxYrDq4OOvq4CoIgh8gbm5Oii5S4v+SQosYD4778e7e4+4dIDQqTDUD44CqWUY6ERezuVUx+AoBAYQxhFGJmfpcKpWE5/i6h4+vdzGe5X3uzxFW8iYDfCLxLNMNi3iDeHrT0jnvE0dYSVKIz4nHDLog8SPXZZffOBcdFnhmxMik54kjxGKxg+UOZiVDJZ4ijiqqRvlC1mWF8xZntVJjrXvyF4by2soy12kOIoFFLCEFETJqKKMCCzFaNVJMpGk/7uEfcPwpcsnkKoORYwFVqJAcP/gf/O7WLExOuEmhOND1Ytsfw0BwF2jWbfv72LabJ4D/GbjS2v5qA5j5JL3e1qJHQO82cHHd1uQ94HIH6H/SJUNyJD9NoVAA3s/om3JA3y3Qs+b21trH6QOQoa6SN8DBITBSpOx1j3d3d/b275lWfz9SLHKa5k3rkgAAAAlwSFlzAAAuIwAALiMBeKU/dgAAAAd0SU1FB+UCBA0gGh/Bqi0AAAAZdEVYdENvbW1lbnQAQ3JlYXRlZCB3aXRoIEdJTVBXgQ4XAAAADElEQVQI12P4z8AAAAMBAQAY3Y2wAAAAAElFTkSuQmCC",
                    "filename": "pixel.png"
                }
            ]
        }
    ]
}
```

### Example output for the listing endpoint:

```json
{
    "data": [
        {
            "subject": "Plain text e-mail example",
            "recipient": "one@example.com",
            "body": "Just a plain text message.\n",
            "attachments": []
        },
        {
            "subject": "HTML e-mail example",
            "recipient": "two@example.com",
            "body": "<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n<meta charset=\"UTF-8\">\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<title>HTML e-mail example</title>\r\n</head>\r\n<body>\r\n<p><b>HTML</b> e-mail example</p>\r\n</body>\r\n</html>\n",
            "attachments": []
        },
        {
            "subject": "Plain text e-mail with attachment example",
            "recipient": "three@example.com",
            "body": "You should see a 1x1 pixels PNG image attached.\n",
            "attachments": [
                {
                    "filepath": "pixel.png"
                }
            ]
        }
    ]
}
```
