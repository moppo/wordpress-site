var $s = jQuery.noConflict();

$s(function(){
  
  var insSpanEl = $s('span.price>ins');
  var delSpanEl = $s('span.price>del');
  var insPEl = $s('p.price>ins');
  var delPEl = $s('p.price>del');

  if ( params.isAdmin ) {
    insSpanEl.empty(); //remove
    insPEl.empty(); //remove
    if ( delSpanEl.parent().html() ) delSpanEl.parent().html().replace('<del>','<ins>'); //replace
    if ( delPEl.parent().html() ) delPEl.parent().html().replace('<del>','<ins>'); //replace
  } else {
  	delSpanEl.empty(); //remove
  	delPEl.empty(); //remove
    if ( insSpanEl.parent().html() ) insSpanEl.parent().html().replace('<ins>','<del>'); //replace
    if ( insPEl.parent().html() ) insPEl.parent().html().replace('<ins>','<del>'); //replace
  }
}); // END DOCUMENT.READY