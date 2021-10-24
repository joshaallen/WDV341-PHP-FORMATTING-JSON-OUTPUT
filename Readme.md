# **Unit-9 Formatting JSON Output**

## 9-1:PHP-JSON Event Object

The program will do the following:

1. Create a `SELECT` statement that will pull one row/event from your `wdv341_events` table.
    * Use `SQL WHERE` clause to limit the result set to one, and prepare your statement before execution.
2. Format the result into a PHP associative array by setting the PDO fetch style. This will turn the result object row into an associative array using the column names as the indexes.
3. Create a Class called Event and give it a property for every column in your `wdv341_events` table (excluding the date_inserted/update columns). There are a couple of ways to make the properties editable by your code. Both have their place and will work. Please understand why you would use either of them.
    * You can make the properties public so they can be mutated on the fly
    * You can make the properties private and create public getters and setters to let users modify their values
4. Create a PHP object called $outputObj and assign it to be an instance of the Event class.
5. Assign a value to each property of your `$outputObj` instance based on the row you pulled from yoru DataBase (DB). There are a few of ways to do this
    1. You can manually set each property value (if the properties are public)
    2. You can set them in the constructor as long as your Class constructor is set up for this
    3. You can use your setters if you set them up
6. Encode the `$outputObj` into a JSON object using `json_encode`
7. Echo the JSON object
8. Test you page and view the response in your localhost browser.

