(function() {
  $(function() {
    $('.highslide').on('click', function(event) {
      return hs.expand(event.currentTarget);
    });
    return $(document).on('contextmenu', 'img', function(event) {
      return false;
    });
  });

}).call(this);
