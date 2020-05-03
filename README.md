# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# In PROGRESS:        
    Movies filter (at least show by few types and order by genres and seperate shown types in profile (completed, planning..))
    
    User reporting
    
    Post reporting
        
# TODO list (fixes or small details):          
    Profile:
        add loading animation to info row
            profile bar
                animation when apearing in small screen mode
            
    Movie page:
        add loading like in profile info row
        add more movie info (genres, popularity stats)
        fix screen reactivity
        
    Add rating from my website (in movie page, movie dialog, profile?)
        
# TODO list (new functions):
    Movies main page:
        ADD suggest movie component
        
    Login / signup:
        ADD background card with picture of main page on the left (after main page is done)
        
    Header
        ADD Search for a movie (probably search self db first an show button to o better search - in API):
            show movies in list, open movie list on click (now only showing search input - does no action)
        
    Profile:
        ADD Followed/Following users (??)
    
    Refresh token

# what is DONE (but might still be expanded):
    Mostly responsive design

    Admin menu:
        admin can review users, chang their roles or ban them from chat until specific day
    
    Main page:
        Showing 5 most popular movies and color based line which is calculated by most popular movie.
        Feed:
            shown users posted messages (html tags compatible)
            user can post messages
            user can comment on messages and review others comments
            messages are updating every 10 secons (getting 1 newest message)
        showing users 5 of watching and planning movies

    Profile page
        user can edit profile (edit info, change profile picture)
        showing main wall with all users made posts
        Showing users info
        Showing users movies list
        Movie dialog opens on click
        Dialog doesnt let do any actions when in others profile

    Movies page (all movies)
        Showing all movies in cards
        User can like or add movies to list by pressing icons near movie title, 
          also posible to remove item from list by choosing - remove
        Showing if a movie is liked or added to list (type is shown near button - completed, paused..)
        Color indicating rating of the movie
        Movies dialog with more info about movie
            dialog has like, add to list and rating buttons
            has a button to redirect to main movies page
            
    Movie page:
        shown all info about movie
        
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