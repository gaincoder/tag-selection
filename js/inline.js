$(document).ready(function() {
    currentVals = $('#jstags').val().split(',');
    newNode = '<select id="jstags1" multiple="multiple"></select>';

    $('#jstags').parent().append(newNode);
    $('#jstags').attr('type','hidden');

    $.each(currentVals,function (k,val) {
        if(val.length > 0) {
            var $newOption = $("<option selected='selected'></option>").val(val).text(val);
            $("#jstags1").append($newOption).trigger('change');
        }
    });
    $('#jstags1').select2({
        tags: true,
        allowClear: true,
        multiple: "multiple",
       data: taglistData
    }).trigger('change');

    $('#jstags1').on('change', function(e) {
        $('#jstags').val($('#jstags1').val().join(','));
    });
});

