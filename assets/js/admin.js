(function ($) {
  $(document).ready(function () {
    // Initialize the color picker
    $(".color-field").wpColorPicker();

    // Move the column up an down
    $(".fbs-tab-content.first table:first tbody").sortable();

    $(".fbs-tab-content.first table:first tr").css({
      border: "1px solid #E5E5E5",
      cursor: "move",
    });

    $(".fbs-tab-content.first table:first tr th").css({
      padding: "10px",
    });

    /**
     * This function will sort the active column
     * @since 1.0.0
     * @author Fazle Bari <fazlebarisn@gmail.com>
     */
    function sortColumns() {

      // add the class from in checkbox to the table row
      $('.fbs-tab-content.first table:first input[type="checkbox"]').each(
        function () {
          var className = $(this).attr("class");
          $(this).closest("tr").addClass(className);
        }
      );

      // ALl culumn list. If we add more in future, we need to add here.
      var allColumnsList = ["quantity","thumbnail","price","remove","total","name","stock"];

      // Get active column list from database
      var activeColList = CT_Data.settings.active_col; // Getting as object
      // When plugin install for the first time, active_col will be empty
      if (typeof activeColList === 'undefined') {
        activeColList = {};
      }
      activeColList = Object.keys(activeColList); // Convert to an array

      // Create a new array combining activeColList and allColumnsList, keeping unique values
      var combineColList = $.merge(
        activeColList,
        $.grep(allColumnsList, function (el) {
          return $.inArray(el, activeColList) === -1;
        })
      );

      // Create a new array
      var combineColList = [];

      // Add elements from classOrderNew first
      $.each(activeColList, function (index, value) {
        combineColList.push(value);
      });

      // Then, add elements from classOrder that are not in classOrderNew
      $.each(allColumnsList, function (index, value) {
        if ($.inArray(value, activeColList) === -1) {
          combineColList.push(value);
        }
      });

      var sortedRows = [];

      combineColList.forEach(function (className) {
        var rows = $("." + className);
        rows.each(function () {
          sortedRows.push($(this).clone(true));
        });
      });

      // remove if not match
      $(".fbs-tab-content.first table:first tr").remove();

      // add acrive row
      sortedRows.forEach(function (row) {
        $(".fbs-tab-content.first table:first").append(row);
      });
    }
    // call sortColumns()
    sortColumns();

    // Extra checkbox is appending, after sort. For now i have remove those. maybe there a better way to do that.
    $('.fbs-tab-content.first table:first input[type="checkbox"]')
      .not('tr input[type="checkbox"]')
      .remove();

    // *** Admin tab control start here ***
    var fbsCtTabs = $(".fbs-tab");
    var tabContents = $(".fbs-tab-content");

    function showTab(tabId) {
      fbsCtTabs.each(function () {
        if ($(this).data("tab") === tabId) {
          $(this).addClass("active");
        } else {
          $(this).removeClass("active");
        }
      });

      tabContents.each(function () {
        if (this.id === tabId) {
          $(this).addClass("active");
        } else {
          $(this).removeClass("active");
        }
      });
    }

    fbsCtTabs.on("click", function () {
      var tabId = $(this).data("tab");
      showTab(tabId);
      localStorage.setItem("activeTab", tabId);
    });

    var activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
      showTab(activeTab);
    }
    // *** Admin tab control end here ***

    // Scrolling save button start
    var $scrollButton = $("input.button.fbs-scroll-button");

    $(window).scroll(function () {
      if ($(this).scrollTop() > 200) {
        $scrollButton.fadeIn();
      } else {
        $scrollButton.fadeOut();
      }
    });
  });
})(jQuery);
