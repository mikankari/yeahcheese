(function() {
  $(function() {
    return $('.highslide').on('click', function(event) {
      return hs.expand(event.currentTarget);
    });
  });

}).call(this);
