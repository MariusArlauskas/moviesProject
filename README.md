# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# In PROGRESS:
    1. Main page - Most popular movies
    
    2. Movie page
    
    3. Movies filter (at least show by few types and order by genres)
    
    4. User reporting
    
    5. Admin panel
    
    6. Post reporting
        
# TODO list (fixes or small details):  
    Feed:
        add user reporting
        allow option to share messages in fb/twitter
        
    Profile:
        seperate shown types (completed, planning..)

    Movies page:
        Movie dialog:
            ADD link to movie page and back button redirects
    
    Header:
        fix animation when scrolling down and up
        
# TODO list (new functions):
    ADD admin panel:
        see users info (see if banned from chat or not, allow changing rights to admin)

    Main page:
        show most popular movies (save movie info by days)  
        
    Feed:
        ADD user reporting

    Movies main page:
        ADD filter
        ADD suggest movie component
        ADD show some movies from profile
        
    Login / signup:
        ADD background card with picture of main page on the left (after main page is done)
            
    ADD Movie page:
        show full movie details
        
    Header
        ADD Search for a movie (probably search self db first an show button to o better search - in API):
            show movies in list, open movie list on click (now only showing search input - does no action)
        
    Profile:
        ADD Edit profile option
        ADD Various stats in graphs with ability to share
        ADD Followed/Following users (??)
    
    Refresh token

    ?? - bonus ideas, only if enaught time.

# what is DONE (but might still be expanded):
    Main page:
        showing feed
        Feed:
            shown users posted messages (html tags compatible)
            user can post messages
            user can comment on messages and review others comments
            messages are updating every 10 secons (getting 1 newest message)
        showing users 5 watching and planning movies

    Profile page
        user can edit profile (edit info, change profile picture)
        showing main wall with all users made posts
        Showing users info
        Showing users movies list
        Movie dialog opens on click
        Dialog doesnt let do any actions when in others profile

    Movies page
        Showing all movies in cards
        User can like or add movies to list by pressing icons near movie title, 
          also posible to remove item from list by choosing - remove
        Showing if a movie is liked or added to list (type is shown near button - completed, paused..)
        Color indicating rating of the movie
        Movies dialog with more info about movie
            dialog has like, add to list and rating buttons
        
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