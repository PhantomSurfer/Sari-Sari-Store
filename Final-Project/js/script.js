function openItemsOverlay(){
  document.getElementById("addItemsOverlay").style.display = "block";
}

function closeItemsOverlay(){
  document.getElementById("addItemsOverlay").style.display = "none";
}

function setProductName(clicked_id){
  document.getElementById('addItemsName').innerHTML = clicked_id;
  document.getElementById('setProductName').setAttribute('value', clicked_id);
}