function toggleAnswer(elem) {
    if($('#' + elem).is(":visible")) {
       $('#' + elem).hide('slow');
    }else {
       $('#' + elem).show('slow');
    }
    
}
