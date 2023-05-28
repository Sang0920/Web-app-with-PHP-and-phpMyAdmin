<footer class="bg-info mt-5">
    <div class="container text-center">
        <p class="text-white">&copy; <span id="currentYear"></span> - Do The Sang</p>
        <a href="https://github.com/Sang0920/Web-app-with-PHP-and-phpMyAdmin">Source code</a>
    </div>
</footer>

<script>
    const currentYear = new Date().getFullYear();
    document.getElementById("currentYear").textContent = currentYear;
</script>
</body>

</html>