  <span class="ui-widget">
    <label for="searchBox">Search:</label>
    <input id="searchBox" />
  </span>

  <script type="text/javascript">
  $(function() {
    $( "#searchBox" ).autocomplete({
    source: function(req, add)
    {
      $.ajax({
        url: '<?php echo site_url('ajax_search/'. $search_module);?>',
        dataType: 'json',
        type: 'POST',
        data: req,
        success:function(data)
        {
          if(data.response =='true')
          {
            add(data.message);
          }
        }
      });
    },
        minLength: 1,
        select: function( event, ui ) 
        {
          window.location = ui.item.destination ;
        }
  });
  });
  </script>