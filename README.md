# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# In PROGRESS:
    Need to think of a better way to save movies.
        Add movie ranking to db for each rank it has
    Movies page:
        user can like movies
        user can ADD movies as watched,planning,dropped (probably in movie dialog)
        
# TODO list (fixes or small details):
    Login problem
        when loggin in user links in profile bar does not set correctly (probably setting them before getting uid)
    Movies page:
        Show title hint only if title is long enaught (??)
        Movies dialog:
            add more data about movies (??)
            add color based score indicator
        
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
        
    ADD Forum (??)
    
    Refresh token

    ?? - bonus ideas.

# what is DONE (but might still be expanded):
    Profile page
        Showing basic users info

    Movies page
        Showing movies in cards
        Showing movie module with more info about movie
        
    Profile toolbar
        Toolbar with easier navigation shows up when user is logged in
        
    Header with navigation for offline users
    
    Login page
        BackEnd JWT authorization
    
    Register page
        
    BackEnd saves user seen movies for a day (since api does not let permanent saving)
        Not saving movies until request for them is made.