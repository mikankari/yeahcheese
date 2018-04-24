$ ->
    $ '.highslide'
        .on 'click', (event) ->
            hs.expand event.currentTarget
    $ document
        .on 'contextmenu', 'img', (event) -> false
