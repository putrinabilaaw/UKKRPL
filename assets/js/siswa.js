 function toggleFeedback(id) {
        const feedbackDiv = document.getElementById(id);
        if (feedbackDiv.style.display === "none" || feedbackDiv.style.display === "") {
            feedbackDiv.style.display = "block";
        } else {
            feedbackDiv.style.display = "none";
        }
    }