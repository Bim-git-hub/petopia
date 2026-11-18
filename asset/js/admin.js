function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('overlay').classList.toggle('show');
}
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape'){
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('show');
  }
});
