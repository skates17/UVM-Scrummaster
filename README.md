# PHP MySQL Hackathon Example

Author: _jim conallen, jconallen@us.ibm.com_

Last Modified: _10-Feb, 2017_

## Overview

This PHP example app demonstrates a simple, reusable PHP web application with MySQL Support.  The app
uses a database to store simple TODO items, and has a page that displays the current weather
conditions for a given zip code.  

This code assumes it is deployed to Bluemix, and that services for
MySQL (ClearDB or the Experimental MySQL) and Weather Insights have already been provisioned for 
the app.  If you deployed this app to your Bluemix and GitHub space with the Deploy to Bluemix Toochain 
button the necessary deployment pipeline will take care of service creation for you.  

If you just forked this project from GitHub, you will need to make sure that the services for
MySQL and Weather Insights are created before you push the code to Bluemix.  

## Deployment Options

Use the Deploy to Bluemix Toolchain button below to quickly create your own instance of this 
application in your Github and Bluemix environment.

[![Deploy to Bluemix](https://developer.ibm.com/devops-services/wp-content/uploads/sites/42/2016/05/create_toolchain_button.png)](https://console.ng.bluemix.net/devops/setup/deploy/?repository=https%3A%2F%2Fgithub.com%2Fjconallen%2FPHP-MySQL-Hackathon-Example)


