# swapiConsumer
This application is written in simple PHP.
I used composer to install the dependencies.
I used PHP 5.6.6 but it should work with most versions.

To search by ship name add a parameter to the request query of "searchByShipName" and it will search for any ships with the word you want to filter by.  Unfortunately it doesn't handle spaces yet.

To sort the list by price add a parameter to the request query of "sortByPrice" with a value of "asc" for an ascending sort and "desc" for a descending sort.

To filter by price add a parameter to the request query of "filterByPrice" which assumes an exact match.  To specifiy a different filter use the parameter "filterByPriceType" with a value of:
"greater" - veiw all ships costing more than your price
"less" - view all ships costing less than your price

Unfortunately I was unable to create a view for the pilots of each starship, that will have to be done in the next episode.