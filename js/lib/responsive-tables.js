var targetTableClass = "table-sp2";
var tableWrapperClass = "table-wrapper";
var tablePinnedClass = "pinned";
var tableScrollableClass = "scrollable";


$(document).ready(function() {
  var switched = false;
  var updateTables = function() {
    if (($(window).width() < 767) && !switched ){
      switched = true;
      $("table."+targetTableClass).each(function(i, element) {
        splitTable($(element));
      });
      return true;
    }
    else if (switched && ($(window).width() > 767)) {
      switched = false;
      $("table."+targetTableClass).each(function(i, element) {
        unsplitTable($(element));
      });
    }
  };

  $(window).load(updateTables);
  $(window).on("redraw",function(){switched=false;updateTables();}); // An event to listen for
  $(window).on("resize", updateTables);


    function splitTable(original)
    {
        original.wrap("<div class='table-wrapper' />");

        var copy = original.clone();
        copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
        copy.removeClass(targetTableClass);

        original.closest(".table-wrapper").append(copy);
        copy.wrap("<div class='pinned' />");
        original.wrap("<div class='scrollable' />");

        // setCellHeights(original, copy);
        // =======Customize
        // for scroll height  by @Garyuten 2014.06.07
        var scrollable = original.parents(".table-wrapper").find(".scrollable");
        var pinned = original.parents(".table-wrapper").find(".pinned");
        if (scrollable.height() > pinned.height) pinned.height(scrollable.height());
        else scrollable.height(pinned.height());

        // コピーした後に行の高さを揃える
        setCellHeights(pinned, scrollable);
    }

    function unsplitTable(original) {
      original.closest(".table-wrapper").find(".pinned").remove();
      original.unwrap();
    }

  function setCellHeights(original, copy) {
    var tr = original.find('tr'),
        tr_copy = copy.find('tr'),
        heights = [];

    tr.each(function (index) {
      var self = $(this),
          tx = self.find('th, td');

      tx.each(function () {
        var height = $(this).outerHeight(true);
        // alert(height);
        heights[index] = heights[index] || 0;
        if (height > heights[index]) heights[index] = height;
      });
    });

    // =======Customize by @Garyuten 2014/06/08
    tr.each(function (index) {
      $(this).height(heights[index]);
    });

    // =======//Customize end
    tr_copy.each(function (index) {
      $(this).height(heights[index]);
    });
  }

});
