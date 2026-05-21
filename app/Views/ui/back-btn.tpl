<a href="javascript:history.back()" class="back-btn" onclick="goBack(event)">
    ←
</a>

<script>
   function goBack(e) {
       e.preventDefault();
  
       if (document.referrer && document.referrer !== window.location.href) {
           history.back();
       } else {
           window.location.href = "/";
       }
   }
</script>
