# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# In PROGRESS:
    1. Profile:
        ADD My movie lists (completed, planning...)
        
    2. Feed:
        user can post messages
        show messagess probably one every xx secs
        allow some html tags
        allow option to share messages in fb/twitter
        
# TODO list (fixes or small details):
    Retrieving movies to users list:
        only posible way to retrieve all - one with one api call (from TMDB)
        
    Movies page:
        Movie dialog:
            ADD like movies and add to list buttons (??)
            ADD link to movie page
    
    Header:
        fix animation when scrolling down and up
        
# TODO list (new functions):
    Movies main page:
        ADD filter
        ADD suggest movie
        ADD show movies from profile 
        ADD chat
            sharing message to twitter/fb
        
    Login / signup:
        ADD background card with picture of main page on the left (after main page is done)
        
    Search module (now only showing search input - form)
            
    ADD Movie page:
        show full movie details
        
    ADD Search:
        show movies in list, open movie list on click
        
    Profile:
        ADD Edit profile
        ADD ability for a user to customize profile theme (??)
        ADD Various stats in graphs with ability to share
        ADD Followed/Following me users
        ADD my wall with all posts made by me
        
    ADD Forum (??)
    
    Refresh token

    ?? - bonus ideas.

# what is DONE (but might still be expanded):
    Profile pages
        Showing basic users info

    Movies page
        Showing all movies in cards
        showing if a movie is liked or added to list (type is shown near button - completed, paused..)
        user can like or add movies to list by pressing icons near movie title, 
          also posible to remove item from list by choosing status - removed
        color indicating rating of the movie
        Movies dialog with more info about movie
        
    Profile toolbar
        Toolbar with easier navigation shows up when user is logged in
        
    Header with navigation for offline/online users
    
    Login page
        User can login with email and password
        BackEnd JWT authorization
    
    Register page
        User can register
        
    BackEnd saves users checked out in site movies for a day (since api does not let permanent saving)
        Not saving movies until request for them is made.
        
    Logging user out if his session end and he tried to do someething without access (will be changed to refresh token in the future)