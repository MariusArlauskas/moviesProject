# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# In PROGRESS:
    Need to think of a better way to save movies:
        -? Add movie ranking to db for each rank it has (popular:1, recent:10, ...)
    Movies page:
        user can like movies (only visuals - need to connect to push to db)
        user can ADD movies as watched,planning,dropped (probably in movie dialog)
        
# TODO list (fixes or small details):
    Retrieving movies to users list:
        only posible way to retrieve all one by one api call (from TMDB)
    Movies page:
        Show what type of status movie has (completed/watching) (??)

    When session ends log user out
    
    Header:
        fix animation when scrolling down and up
        
# TODO list (new functions):
    Movies page:
        ADD filter
        ADD suggest movie
        ADD show movies from profile 
        ADD chat
            sharing message to twitter/fb
        
    Login / signup:
        ADD background card with picture if main page on the left
        
    Search module (now only showing search input - form)
            
    ADD Movie page:
        show full movie details
        
    ADD Search:
        show movies in list, open movie list on click
        
    Profile:
        ADD Edit profile
        ADD ability for a user to customize profile theme (??)
        ADD Various stats in graphs with ability to share
        ADD My movie lists (completed, planning...)
        ADD Followed/Following me users
        ADD my wall with all posts made by me
        
    ADD Forum (??)
    
    Refresh token

    ?? - bonus ideas.

# what is DONE (but might still be expanded):
    Profile pages
        Showing basic users info

    Movies page
        user can like movies by pressing heart icon
        Showing movies in cards
        Movies Module with more info about movie
            color indicating rating of the movie
        
    Profile toolbar
        Toolbar with easier navigation shows up when user is logged in
        
    Header with navigation for offline/online users
    
    Login page
        BackEnd JWT authorization
    
    Register page
        
    BackEnd saves user seen movies for a day (since api does not let permanent saving)
        Not saving movies until request for them is made.