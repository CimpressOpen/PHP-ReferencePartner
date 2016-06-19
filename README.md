## Reference Partner ##

Note:
This is not a SDK nor does it make use of an SDK. This is a verbose implementation of Cimpress Open Print Fulfillment API. 
Do not use the implementation of JWT Token handling nor storing. When making CURL calls to the Endpoints assure you DO check the SSL trust chain.

Have fun!

### To get started ###
To get started you need to do one thing! Plug in your login credentials.
In the root of the project ./ReferencePartner/config/credentials.txt
Fill in the fields as seen.
* The way JWT management was implemented is that if the token is valid it will NOT regenerate from the credentials provided inthe credentials.txt file. You must go remove the contents of src/lib/Authorization/JWT.txt to get the program to re-genereate the JWT.

#### PHP ####
On Windows I used WAMP to host the webserver I needed, it is running apache server and PHP 5.X.

Apache Config:
Search for the "AddType" keyword and add the line below to the section.
In your apache config (httpd.conf) add the following lines:
	AddType application/x-httpd-php .html


###### Sources:
Bootstrap: 
http://getbootstrap.com/
 
Landing Page: 
https://github.com/BlackrockDigital/startbootstrap-creative
