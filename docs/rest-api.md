# Operations

Cascade CMS REST API Operations

## Read [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Read>)

`/api/v1/read/{identifier}?{auth}`

You can structure your URL in multiple ways. A few examples are below:

##### Path (`/api/v1/read/{siteName}/{path}/{to}/{asset}`)
    
    
    http://localhost:8080/api/v1/read/page/www.example.com/news/2003/best-of-show
    

##### Asset `identifier` (`/api/v1/read/{identifier})`
    
    
    http://localhost:8080/api/v1/read/page/e9f2f9a1c1a8003a2dba29096e32b2ee
    

## Delete [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Delete>)

`/api/v1/delete/{identifier}?{auth} `

  * Include “deleteParameters” in message body based on {wsdl}
  * Optionally include “workflowConfiguration” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/delete/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## Create [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Create>)

`/api/v1/create?{auth} `

  * Include “asset” in message body based on {wsdl}

    
    
    http://localhost:8080/api/v1/create?u=hill&p=hill
    {
      "asset": {
        "page": {
          "name": "test",
          "parentFolderPath": "/",
          "siteName": "www.example.com",
          "contentTypeId": "b9bc37270a00016b00899e533ba18fe5",
          "xhtml": "<div>Content</div>",
          "metadata": {
            "title": "Page title"
          }
        }
      }  
    }

## Edit [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Edit>)

`/api/v1/edit?{auth} `

  * Include “asset” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/edit?u=hill&p=hill 
    {
      "asset": {
        "page": {
          "id": "b9b0a96c0a00016b00899e5325baab29",
          "contentTypeId": "b9bc37270a00016b00899e533ba18fe5",
          "xhtml": "<div>Content</div>",
          "metadata": {
            "title": "Page title"
          }
        }
      }  
    }

## Copy [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Copy>)

`/api/v1/copy/{identifier}?{auth}`

  * Include “copyParameters” in message body based on {wsdl}
  * Optionally include “workflowConfiguration” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/copy/page/www.example.com/page-to-copy?u=hill&p=hill
    {
      "copyParameters": {
        "newName": "copied-page",
          "destinationContainerIdentifier": { 
            "type": "folder",
            "path": {
              "siteName": "site-name",
              "path": "/"
          }
        }
      }
    }

## Move [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Move>)

`/api/v1/move/{identifier}?{auth}`

  * Include “moveParameters” in message body based on {wsdl}
  * Optionally include “workflowConfiguration” in message body based on {wsdl}

example:
    
    
    {
      "identifier": {
        "id": "ba1d843cac1e00593e785d893ce8cd11",
        "type": "file"
      },
      "moveParameters": {
        "destinationContainerIdentifier": {
          "id": "d8174b287f0000011bd202d182d826d4",
          "type": "folder"
        },
        "doWorkflow": false,
        "unpublish": true
      }
    }

## Publish [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Publish>)

`/api/v1/publish/{identifier}?{auth}`

  * Optionally include “publishInformation” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL.

example:
    
    
    http://localhost:8080/api/v1/publish/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

**Note** : The response `success: true` in this case means that the asset has been successfully added to the publish queue. It does _not_ indicate that the asset has actually been published yet to the corresponding Destinations in the request.

**Tip** : To _unpublish_ , you can include the following in your POST request: 
    
    
    {
      "publishInformation": {
        "unpublish": true
      }
    }

## Search [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#Search>)

`/api/v1/search?{auth}`

  * Include “searchInformation” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/search?u=hill&p=hill
    {
      "searchInformation": {
        "searchTerms":"https://www.hannonhill.com",
        "searchFields": ["xml"],
        "searchTypes": ["page"]
      }
    }
    

**Note** : The `searchFields` and `searchTypes` parameters must be included as arrays as seen above.

## ReadAccessRights [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadAccessRights>)

`/api/v1/readAccessRights/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readAccessRights/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## EditAccessRights [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#EditAccessRights>)

### EditAccessRights

`/api/v1/editAccessRights/{identifier}?{auth}`

  * Include “accessRightsInformation” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL.

## ReadWorkflowSettings [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadWorkflowSettings>)

### ReadWorkflowSettings

`/api/v1/readWorkflowSettings/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readWorkflowSettings/folder/www.example.com/news?u=hill&p=hill

## EditWorkflowSettings [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#EditWorkflowSettings>)

`/api/v1/editWorkflowSettings/{identifier}?{auth}`

  * Optionally include “workflowSettings” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL. If “workflowSettings” is not provided, the folder will have all workflow definitions removed and workflow will not be required or inherited.
  * Optionally include “applyInheritWorkflowsToChildren” with “true” or “false” value (false by default)
  * Optionally include “applyRequireWorkflowToChildren” with “true” or “false” value (false by default)

example:
    
    
    http://localhost:8080/api/v1/editWorkflowSettings/folder/www.example.com/news?u=hill&p=hill

## ListSubscribers [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ListSubscribers>)

### ListSubscribers

`/api/v1/listSubscribers/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/listSubscribers/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

### 

## ListMessages [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ListMessages>)

### ListMessages

`/api/v1/listMessages?{auth}`

example:
    
    
    http://localhost:8080/api/v1/listMessages?u=hill&p=hill

## MarkMessage [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#MarkMessage>)

`/api/v1/markMessage/{identifier}?{auth}`

  * Include “markType” in message body with value “read” or “unread”

example:
    
    
    http://localhost:8080/api/v1/markMessage/message/21903a3d7f000001554c369f276691eb?u=hill&p=hill
    {
      "markType": "read"
    }

## DeleteMessage [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#DeleteMessage>)

`/api/v1/deleteMessage/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/deleteMessage/message/21903a3d7f000001554c369f276691eb?u=hill&p=hill

## CheckOut [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#CheckOut>)

`/api/v1/checkOut/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/checkOut/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## CheckIn [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#CheckIn>)

`/api/v1/checkIn/{identifier}?{auth}`

  * Optionally include string “comments” in message body

example:
    
    
    http://localhost:8080/api/v1/checkIn/page/www.example.com/news/2003/best-of-show?u=hill&p=hill
    {
      "comments": "Here are some comments."
    }

## SiteCopy [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#SiteCopy>)

`/api/v1/siteCopy?{auth}`

  * Include string “originalSiteId” or “originalSiteName” in message body
  * Include string “newSiteName” in message Body

example:
    
    
    http://localhost:8080/api/v1/siteCopy?u=hill&p=hill
    {
      originalSiteName: "www.example.com",
      newSiteName: "new-site"
    }

## ListSites [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ListSites>)

`/api/v1/listSites?{auth}`

example:
    
    
    http://localhost:8080/api/v1/listSites?u=hill&p=hill

## ReadAudits [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadAudits>)

`/api/v1/readAudits/{identifier}?{auth}`

  * Optionally include “auditParameters” in message body based on {wsdl}. Its “identifier” property is not necessary if it was provided in URL.
  * Date behavior: 
    * no dates: last week"s audits, based on current date
    * start date only: all audits after start date
    * end date only: one week’s worth of audits, based on end date
    * start and end date: all audits between dates

example:
    
    
    http://localhost:8080/api/v1/readAudits/user/hill?u=hill&p=hill
    {
       "auditParameters": {
       "startDate": "May 12, 2023 12:00:00 AM",
       "endDate": "Aug 12, 2023 11:59:00 PM"
       }
    }

## ReadWorkflowInformation [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadWorkflowInformation>)

`/api/v1/readWorkflowInformation/{identifier}?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readWorkflowInformation/page/www.example.com/news/2003/best-of-show?u=hill&p=hill

## PerformWorkflowTransition [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#PerformWorkflowTransition>)

`/api/v1/performWorkflowTransition?{auth}`

  * Include “workflowTransitionInformation” in message body based on {wsdl}

## ReadPreferences [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#ReadPreferences>)

`/api/v1/readPreferences?{auth}`

example:
    
    
    http://localhost:8080/api/v1/readPreferences?u=hill&p=hill

## EditPreference [__](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#EditPreference>)

`/api/v1/editPreference?{auth}`

  * Include “preference” in message body based on {wsdl}

example:
    
    
    http://localhost:8080/api/v1/editPreference?u=hill&p=hill
    {
      "preference": {
        "name": "system_pref_global_area_external_link_check_on_publish",
        "value": "on"
      }
    }

[ ↑ ](<https://www.hannonhill.com/cascadecms/latest/developing-in-cascade/rest-api/operations.html#top>)
