# backEnd - Symfony 4 api
// php bin/console server:run

# frontEnd - Vuejs
// npm run serve

# Planned TODOS:
WIP: Profile page | almost done basic view with users info

# TODO list (fixes and small details):
    Movies page:
        Show title hint only if title is long enaught (??)
        Movies dialog:
            ADD more data about movies
    Register page:
        add new fields for user
        
# TODO list:
    Need to think of a better way to save movies.

    Movies page:
        user can like movies
        user can ADD movies as watched,planning,dropped (probably in movie dialog)
        ADD filter
        ADD suggest movie
        ADD show movies from profile 
        ADD chat
            sharing message to twitter/fb
        
    Login / signup:
        ADD background card with picture if main page on the left
        
    Search module (now only showing search input)
            
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
        
    Profile toolbar
        Toolbar with easier navigation shows up when user is logged in
        
    Header with navigation for offline users
    
    Login page
        BackEnd JWT authorization
    
    Register page
        
    BackEnd saves user seen movies for a day (since api does not let permanent saving)
        Not saving movies until request for them is made.