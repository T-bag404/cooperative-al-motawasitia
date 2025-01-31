document.addEventListener("DOMContentLoaded", async function () {
    try {
      const headerResponse = await fetch('../assets/includes/header.html');
      const aboutResponse = await fetch('../assets/includes/about.html');
      const contactResponse = await fetch('../assets/includes/contact.html');
      const footerResponse = await fetch('../assets/includes/footer.html');
  
      const headerData = await headerResponse.text();
      const aboutData = await aboutResponse.text();
      const contactData = await contactResponse.text();
      const footerData = await footerResponse.text();

      document.getElementById('include-header').innerHTML = headerData;
      document.getElementById('include-about').innerHTML = aboutData;
      document.getElementById('include-contact').innerHTML = contactData;
      document.getElementById('include-footer').innerHTML = footerData;
    } catch (error) {
      console.error('Error fetching files:', error);
    }
  });
  