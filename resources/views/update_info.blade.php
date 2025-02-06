<script>

    // PERSONAL INFO(OTHER CITIZENSHIP UPDATE)
    $(document).ready(function () {
        $('#ctzen_membership').change(function () {
            var nation = '<?= ($records['result_info'][0]['othercitizenship']) ?>';
            if ($(this).val() == 'FOREIGNER') {
                $('#nationality').removeAttr("hidden");
                $('#nationality1').removeAttr("hidden");
                $('#nationality').val(nation);
            } else {
                $('#nationality').attr('hidden', 'hidden');
                $('#nationality').val('');
                $('#nationality1').attr('hidden', 'hidden')
            }
        });

        var type_membership = '<?= $records['result_record']['sponsor_name']?>';
        // console.log(type_membership);
        var hi = $('.member').val(type_membership).change();
    });

    $(document).ready(function () {

        // PERSONAL INFO  
        $(".update_personal").hide();

        // Toggle icons on click
        $('.fas.fa-edit.personal').click(function () {
            $(this).hide();
            $('.fas.fa-x.personal').show();
            $(".update_personal").toggle();
            $(".check").prop("disabled", false);
        });

        $('.fas.fa-x.personal').click(function () {
            $(this).hide();
            $('.fas.fa-edit.personal').show();
            $(".update_personal").toggle();
            $(".check").prop("disabled", true);
        });

        // Other functionality can remain here as needed
        $('.personal').change(function () {
            if ($(this).is(":checked")) {
                $(".update_personal").show();
                $(".check").prop("disabled", false);
            } else {
                $(".update_personal").hide();
                $(".check").prop("disabled", true);
                if ($(".check").is(":checked")) {
                    $(".check").prop("checked", false);
                }
                $('#nationality').attr('hidden', 'hidden');
                $('#nationality1').attr('hidden', 'hidden');
                $('#uptitle').val('');
                $('#upbirthplace').val('');
                $('#upgender').val('');
                $('#ctzen_membership').val('');
                $('#upstatus').val('');
                $('#upoccupation').val('');
            }
        });

        // CONTACT INFO

        $(".update_contact").hide();

        // Toggle icons on click
        $('.fas.fa-edit.contact').click(function () {
            $(this).hide();
            $('.fas.fa-x.contact').show();
            $(".update_contact").toggle();
            $(".check").prop("disabled", false);
        });

        $('.fas.fa-x.contact').click(function () {
            $(this).hide();
            $('.fas.fa-edit.contact').show();
            $(".update_contact").toggle();
            $(".check").prop("disabled", true);
        });

        // Other functionality can remain here as needed
        $('.contact').change(function () {
            if ($(this).is(":checked")) {
                $(".update_contact").show();
                $(".check").prop("disabled", false);
            } else {
                $(".update_contact").hide();
                $(".check").prop("disabled", true);
                if ($(".check").is(":checked")) {
                    $(".check").prop("checked", false);
                }
                $('#street').val('');
                $('#town').val('');
                $('#city').val('');
                $('#province').val('');
                $('#zcode').val('');
                $('#company').val('');
                $('#street1').val('');
                $('#town1').val('');
                $('#city1').val('');
                $('#province1').val('');
                $('#zcode1').val('');
                $('#uphousephone').val('');
                $('#mail').val('');
                $('#upmobileno').val('');
                $('#upaltmobileno').val('');
                $('#upemail').val('');
                $('#upaltemail').val('');
            }
        });


    });

    $(document).ready(function () {
        // ______update yes or no for store in database
        function toggleSelect() {
            var radioValue = $('input[name="uradio"]:checked').val();
            $('#uptitle, #upbirthplace, #upgender, #upstatus, #upoccupation, #street, #town, #city, #province, #zcode, #company, #street1, #town1, #city1, #province1, #zcode1, #upphoneno, #upofficephoneno, #upaddress, #upmobileno, #upaltmobileno, #upemail, #upaltemail').prop('disabled', (radioValue == 0));
        }
        $('#uyes, #uno').change(toggleSelect);
        toggleSelect();
    });
</script>