$( function() {
    $( "#range" ).slider({
        range: true,
        min: 0,
        max: 100,
        values: [ 25, 75 ],
        slide: function( event, ui ) {
            $( "#range" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
        }
    });
    $( "#range" ).val( $( "#range" ).slider( "values", 0 ) +
        " - " + $( "#range" ).slider( "values", 1 ) );
});