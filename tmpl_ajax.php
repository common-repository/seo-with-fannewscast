<script type="text/javascript">
   function fnc_jquery_check(){
    return window.jQuery && jQuery.fn && /^1\.[3-9]/.test(jQuery.fn.jquery);
  }
  if(!fnc_jquery_check()) {
    var s = document.createElement('script');
    s.setAttribute('src', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    s.setAttribute('type', 'text/javascript');
    document.getElementsByTagName('head')[0].appendChild(s);
  }

  var fnc_content = {
    $fnc: null,
    cache: {},
    init: function(id)
    {
      this.$fnc = jQuery(id);
      if (!window.fnc_content_cache){
        window.fnc_content_cache = {};
      }
      this.$fnc.find('.page-static-url').show();
      this.initPagination();
      this.initSort();
      this.initSearch();
      this.initSearchClear();
    },
    initPagination: function()
    {
      var that = this;
      this.$fnc.find('.pagination-inner a').click(function(e)
      {
        e.preventDefault();
        var $this = jQuery(this);

        that.doRequest($this.attr('href'));
      });
    },
    initSort: function()
    {
      var that = this;
      this.$fnc.find('.sortoptions a').click(function(e)
      {
        e.preventDefault();
        var $this = jQuery(this);
        that.doRequest($this.attr('href'));
      });
    },
    initSearch: function()
    {
      var that = this;
      this.$fnc.find('.search-bar form').submit(function(e){
        e.preventDefault();
        var location = window.location.pathname;
        that.overlay(that.$fnc);
        that.doRequest(location + '?' + that.$fnc.find('.search_text').attr('name')
            + '=' + (that.$fnc.find('.search_text').val()).replace('&', '%26'));
      });
      this.$fnc.find('.search-bar .clearsearchlink').click(function(e)
      {
        e.preventDefault();
        var $this = jQuery(this);
        that.doRequest($this.attr('href'));
      });
    },
    initSearchClear: function()
    {
      var that = this;
      this.$fnc.find('.clearsearchlink').click(function(e)
      {
        e.preventDefault();
        var $this = jQuery(this);
        that.doRequest($this.attr('href'));
      });
    },
    overlay: function($object)
    {
      jQuery('<div id="ajax-busy"/>').css({
        opacity: 0.5,
        position: 'absolute',
        'z-index': '100',
        top: 0,
        left: 0,
        width: $object.width() + 'px',
        height: $object.height() + 'px',
        background: 'white no-repeat center'
      }).appendTo($object);

    },
    doRequest: function(href, callback)
    {
      var that = this;
      var data = {
        action: 'fnc_refresh',
        atts: '[%atts%]',
        loc: window.location.pathname,
        href: href
      };

      that.overlay(that.$fnc);
      if (href in window.fnc_content_cache){
        if (callback){
          callback(window.fnc_content_cache[href]);
        }
        else
        {
          that.$fnc.replaceWith(window.fnc_content_cache[href]);
        }
      }
      else
      {
        jQuery.post('[%ajaxurl%]', data, function(response) {
          window.fnc_content_cache[href] = response;
          if (callback){
            callback(response);
          }
          else
          {
            that.$fnc.replaceWith(response);
          }
        });
      }
    }
  }
   if ( fnc_jquery_check() ) {
     fnc_content.init('#[%varprefix%]_content');
   } else {
         timer = setInterval(function(){
           if ( fnc_jquery_check() ) {
             clearInterval(timer);
             fnc_content.init('#[%varprefix%]_content');
           }
         }, 30);
   }

</script>