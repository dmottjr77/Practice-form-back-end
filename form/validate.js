document.getElementById('contactForm').addEventListener('submit',function(e){
 const form=this;
 const status=document.getElementById('status');
 if(!form.checkValidity()){
   e.preventDefault();
   status.textContent='Please complete all fields correctly.';
 }
});
