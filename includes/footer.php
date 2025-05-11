<style>
    /* Footer Styles */
footer {
    background-color: black;
    color: #ecf0f1;
    padding: 20px 0;
    text-align: center;
    border-top: 4px solid black;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
}

.footer-container p {
    font-size: 1rem;
    margin: 10px 0;
    color: #bdc3c7;
}

.social-links {
    list-style: none;
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 0;
    padding: 0;
}

.social-links li a {
    color: red;
    text-decoration: none;
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.social-links li a:hover {
    color: white;
}

/* Responsive Footer */
@media (max-width: 768px) {
    .social-links {
        flex-direction: column;
        gap: 10px;
    }
}

</style>
<footer>
    <div class="footer-container">
        <p>&copy; <?php echo date("Y"); ?> Ailszone. All rights reserved.</p>
        <ul class="social-links">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
        </ul>
    </div>
</footer>
</body>
</html>
