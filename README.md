*Note: I'm using an online bootstrap linking so make sure that there is an internet connection*

# The web app consists of 5 sections

1. Home page
2. Shipped items page
3. Retail center page 
4. Transportation event page
5. Processes page


## Home page
> It contails a dashboard that will display a table of shipped items with all relations in the web app.
> It displays the retail centers that receives the shipped item and also the transportation method.
> Every item has a delete button that removes this value and all values related in the table.

## Shipped items page
> Contains a table with all information about shipped items.
> Each row has two buttons to update and delete each row individually.
> There's a `insert new item button` that leads to a form to insert a new item.

## Retail center page
> Contains a table with all information about Retail centers.
> Each row has two buttons to update and delete each row individually.
> There's a `insert new item button` that leads to a form to insert a new item.

## Transportation event page
> Contains a table with all information about Transportation event.
> Each row has two buttons to update and delete each row individually.
> There's a `insert new item button` that leads to a form to insert a new item.

## Processes page
> This page is perform all the relations between the 3 tables.
> There's two forms where you can add relations between Retail center, Transportation event with the shipped items.
> After all relations is added dashboard at the home page will be updated.


### To start the app
1. Make sure that you have laravel installed on you machine.
2. configure the `.env` file to connect to your data base.
3. Run ``` php artisan migrate ``` to create all tables needed.
4. Run ``` php artisan serve ``` to run the web app on localhost.