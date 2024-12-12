<!-- - Architecture -->
- How do you structure a large-scale Laravel application? Which includes but not limited to:
	- Database
		factories ( can be used for unit testing by creating bulk and random data )
		migrations ( creating table & indexing )
		seeders ( Seed data to table which are predefined/default data )

	- Application Server
		Events ( Used for triggering action during certain process )
		Controllers ( Mainly for request validation and passing request to repository )
		Middleware ( Serve as a gateway to check credential or specific data )
		Request ( Customize request validation used on controller )
		Jobs ( Logic of job for queue after job is dispatched )
		Listener ( Undergoes a certain action when main thread triggered )
		Models ( Initiate the table detail to allow table access )
		Observers ( Trigger logic when table crud )
		Providers ( Boot service provider )
		Repositories ( Main logic for the main thread )
		Rules ( Predefined logic rules to check if data is eligible )
		Scopes ( Create a eloquent for common query logic )
		Services ( Used for model action )
		Views ( Access to a predefined complex query in db ) 
		Webservices ( logic and checking for external services )

	- Front ends like mobile apps, web and etc.
		Laravel Blade is used on frontend as view.

	- Static Contents
		Static content which are reusable file are stored under public folder which includes folder such as css,js,images and files including index.php, web.config or .htaccess.
		Both web.config and .htaccess serves the same functions on web servers as a entry point for routing and allowing request to index.php. Index.php is a gateway which loads up the autoload from composer and handling the http request using kernel.

	- Common libraries
		Helpers ( Allow multiple files to use common function )
		Traits ( Allow multiple files to use common code/logic )

- How do you handle different environments (development, staging, production)?
	- Which tools/services are used to manage different environments?
		Gitlab is used to switching between branch and looking through history of commit while jira with bitbucket will be used to creating a new development branch.

	- When you auto-scale your application, how do you make sure all application nodes are using the same
 		From previous experience, development .env will be used for accessing local environment variable. As for staging and production both environment variable are stored on AWS EB / docker (pubsub project).

- How do you manage dependencies (libraries and packages) in your Laravel application?
	Composer will be used to adding or updating any package or libraries. The version of package can be constrain by modifying the package version in composer.json file. Bitbucket can also be used for version control by integrating with jira.

- Which tools/services are used to manage dependencies?
	Composer & Git

- How do you handle dependency conflicts?
	Git can be used to ensure all package version used in different environment are the same preventing any dependency conflicts by composer.json file.

- How do you automate testing in your Laravel application?
	Unit test and feature test are widely used which unit test used for tesing on a specific function and feature test used for testing a feature in whole such as the flow of creating transactions. AWS Code build can also be paired with AWS EB so that server will run a specific test command whenever there is any deployment. Puppeteer can be used to simulate a certain flow such as deposit or creating transaction.

- Which tools/services are used to automate testing?
	Laravel Unit Test, Laravel Feature Test, AWS CodeBuild, Puppeteer

- How do you handle tests that require external services
	For test that requires external services, Laravel fake can be used to imitate the service behaviour or manually modify the env variable to the service test api ( if any ).

- How do you handle logging and error handling in your Laravel application?
	Code wise we use a customise try catch to prevent any unexpected error from happening whenever a error occurs.
	Database we written a customize database try catch function that does database transaction when modifying the data which will rollback and log when any error occur preventing case like uncomplete date updating.
	Request validation, we specify each param validation such as ( required, type of data, customise error message ) before passing through controller to control error from request param.
	External services, AWS Cloudwatch is be used to monitor the error occured which is much easier since it has a UI comparing to laravel log.

- Which tools/services are used to handle logging and error handling?
	DB Transaction, Laravel Request, AWS Cloudwatch



<!-- - Database -->
- In what situation, you need to decide which database to use? and why?
	- Transactional database
		Suitable for storing complicated and integrity data with required for loads of table joining as it requires a structure and predefined column in table. Example of using transaction database will be the detail of member, member bank, transactions and other predefined data in a wholesome system.
	- NoSQL database
		Generally is more prefered on storing data such as messaging or live graph updating ( trading ) which data are constantly changing due to it's flexibility on data and the capabilities of fast reading and writing. Flexibility, meaning it allow data to be store more dynamically without any predefined structure. Example of NoSQL are texts of member, comment on live streaming and other real time services that required rapid storing.  

- If there are situations where some of the features are not suitable for the database you selected above, what would you do to cope your business requirements? and how you come to this decision?
	In the event of both database are required such as a CRM system that implement chat feature, AWS RDS can be used for storing structured data such as detail, transaction, promotion or bank account while AWS DynamoDB can be used for storing message details and content. Reason being there is a past experience on using dynamoDB to store Telegram bot messages and displaying it on backend side.



<!-- - Optimization -->
- Which tools/services are used to optimize your Laravel application?
	Load balancer, AWS SQS queue, AWS Elastic Cache, DB Indexing, AWS Lambda

- In the event of traffic spikes, where would you start looking into? and why?
	AWS Cloudwatch can be used to monitor the traffic if any request is timeout or monitor db whigh usage by showing heavy queries that affecting the performance.

- How do you monitor and analyze your application's performance?
	AWS EB also provide load balancing feature which diversify the traffic to a more equilibrium manner. Caching can temperory save a specific data such as member access token resulting application acknowledge that the member is login without checking multiple times. 

- How do you handle caching and minimize database queries?
	Commonly used column such as primary or secondary key can add indexing to improve the performance when joining table.
	Adding cache for query which store the results for certain amount of time after first querying preventing any duplicates query called in the time frame. 
	A Laravel eloquent consists of eager loading that enable it to run in a single query instead of querying multiple table. 
	Implementing a lambda function which runs once every certain period to summarize the data in a table into a row so that the table will have a better performance when accessing. 

- How do you handle background tasks and avoid blocking the main thread?
	SQS queue can be used whenever there's sub task to process which enable backgroun process for the subtask without interfering the main thread.
