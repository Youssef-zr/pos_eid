// check sidebar collapsing status
if (localStorage.getItem("aside-closed") == "true")
    $("body").addClass("sidebar-collapse");
else $("body").removeClass("sidebar-collapse");

$(() => {
    // hide dashboard loading page
    let loadingOverlay = $(".loading-dashboard");
    loadingOverlay.css({
        width: $(window).width() - $("aside").width(),
    });

    setTimeout(() => {
        loadingOverlay.fadeOut(1000);
    }, 500);

    // toggle aside bar menu
    $("#toggleMenu").on("click", function () {
        if ( localStorage.getItem("aside-closed") == "true") {
            localStorage.setItem("aside-closed", "false");
        } else {
            localStorage.setItem("aside-closed", "true");
        }
    });

    // show password
    $(".show-password").click(function () {
        let inptPassword = $(this).siblings("input");

        console.log(inptPassword);
        if (inptPassword.prop("type") == "password") {
            inptPassword.prop("type", "text");
        } else {
            inptPassword.prop("type", "password");
        }

        let iconEye = $(this).find("i");
        iconEye.toggleClass("fa-eye fa-eye-slash");

        if (iconEye.hasClass("fa-eye")) {
            iconEye.prop("title", "show password");
        } else {
            iconEye.prop("title", "hide password");
        }
    });

    // show profile dropdown
    $("#show-profile").on("click", function (e) {
        $(this).siblings(".dropdown-menu").slideToggle();
    });

    // export table pdf
    function exportTableToExcel(tableID, filename = "") {
        var downloadLink;
        var dataType = "application/vnd.ms-excel";
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, "%20");

        // Specify file name
        filename = filename ? filename + ".xls" : "excel_data.xls";

        // Create download link element
        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(["\ufeff", tableHTML], {
                type: dataType,
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            // Create a link to the file
            downloadLink.href = "data:" + dataType + ", " + tableHTML;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }
    }

    $("#export-pdf").on("click", function (e) {
        e.preventDefault();
        exportTableToExcel("table");
    });

    // ------------modal buttons --------
    // modal open
    $(".delete-modal").on("click", function (e) {
        e.preventDefault();
        
        const $modal = $(this).data("modal");
        $("#" + $modal).fadeIn();

        let id = parseInt($(this).data("id")),
            form = $("#form-delete");
        form.attr("action", form.data("url") + "/" + id);
    });

    // modal close
    $(".hide-modal").on("click", function (e) {
        e.preventDefault();
        const $modal = $(this).data("modal");
        $("#" + $modal).fadeOut();
    });

    // modal confirm
    $(".confirm-delete").on("click", function () {
        $("#form-delete").submit();
    });

    // check direction and change star filed resuired position
    if ($dir == "rtl") {
        $(".star").css({
            right: "auto",
            left: "-18px",
        });
    }

    // change pagination active button bg color
    setTimeout(() => {
        $(".paginate_button.current").toggleClass("current activated");
    }, 500);

    // start custom input file
    $(".inputfile").each(function () {
        var $input = $(this),
            $label = $input.next("label"),
            labelVal = $label.html();

        $input.on("change", function (e) {
            var fileName = "";

            if (this.files && this.files.length > 1)
                fileName = (
                    this.getAttribute("data-multiple-caption") || ""
                ).replace("{count}", this.files.length);
            else if (e.target.value)
                fileName = e.target.value.split("\\").pop();

            if (fileName) $label.find("span").html(fileName);
            else $label.html(labelVal);

            // change image preview
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#img-preview").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Firefox bug fix
        $input
            .on("focus", function () {
                $input.addClass("has-focus");
            })
            .on("blur", function () {
                $input.removeClass("has-focus");
            });
    });
    // end custom input file
});
