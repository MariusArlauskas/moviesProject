# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# In PROGRESS:
    1. Profile:
        ADD My movie lists (seperated by  types - completed, planning...)
        
    2. Feed:
        user can post messages
        show messages to users probably one every xx secs
        allow option to share messages in fb/twitter
        
# TODO list (fixes or small details):
    Retrieving movies to users list:
        only posible way to retrieve all - one by one from current api
        
    Movies page:
        Movie dialog:
            ADD like movies and add to list buttons (??)
            ADD link to movie page
    
    Header:
        fix animation when scrolling down and up
        
    Feed:
        allow some html tags (??)
        
# TODO list (new functions):
    Movies main page:
        ADD filter
        ADD suggest movie component
        ADD show some movies from profile
        
    Login / signup:
        ADD background card with picture of main page on the left (after main page is done)
            
    ADD Movie page:
        show full movie details
        
    Header
        ADD Search for a movie:
            show movies in list, open movie list on click (now only showing search input - does no action)
        
    Profile:
        ADD Edit profile option
        ADD ability for a user to customize profile theme (??)
        ADD Various stats in graphs with ability to share (??)
        ADD Followed/Following users
        ADD my wall with all posts made by me
        
    ADD Forum (??)
    
    Refresh token

    ?? - bonus ideas, only if enaught time.

# what is DONE (but might still be expanded):
    Profile pages
        Showing basic users info

    Movies page
        Showing all movies in cards
        user can like or add movies to list by pressing icons near movie title, 
          also posible to remove item from list by choosing - remove
        showing if a movie is liked or added to list (type is shown near button - completed, paused..)
        color indicating rating of the movie
        Movies dialog with more info about movie
        
    Profile toolbar
        Toolbar easy navigation of personal info shows up when user is logged in
        
    Header with navigation for offline/online users
    
    Login page
        User can login with email and password
        BackEnd JWT authorization
    
    Register page
        User can register
        
    BackEnd saves users seen on the site movies for a day (since api does not let permanent saving)
        Not saving movies until someone is searching for them.
        
    Logging user out if his session end and he tried to do something without access (will be changed to refresh token in the future)