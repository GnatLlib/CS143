Our website contains:

A search bar that is available as part of the menu on all pages that searched based on the 
project requirements

Pages to show Actor and Movie information
Actor Pages display:
	Actor information
	List of Movie the actor is in and links to the correposnding Movie detail pages

Movie Pages display:
	Movie information
	List of actors in the Movie and links to the corresponding Actor detail pages
	Average score of user reviews
	All the user reviews
	A form that allows the user to add a comment. 


Pages to let the user add Movies, Actors, Directors, MovieActor Relations, and MovieDirector Relations.

Instead of a comment page, we a comment section to the bottom of every Movie detail page,
since this format would make more sense for a user than going to a seperate page, selecting a movie,
then leaving a comment for that page. Instead the php file that handles adding comments is a redirect
page, that returns the user to the movie detail page after 5 seconds.
If we wanted to implement the comment page seperately we could have simply moved the form onto redirect
page, and made a dropdown menu that let's the user select which movie they want to leave a comment for,
like the dropdown menus we created for MovieActor and MovieDirector Relations. 

Our site also has a simple homepage that shows the top 5 movies in the database
based on the sum of their IMDB and Rotten Tomatoes Ratings. 

On our team
Bill Tang(104621566) implemented the display and search functions, menu, site design, and created video and misc files.
Ernest Cheng(104659385) implemented the insert functions

We could have improved our team setting by using version control system like Git so that we could 
see each others progress and utilize each others files more easily. 


