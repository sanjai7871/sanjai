// Modern Form Script - Enhanced User Experience
document.addEventListener('DOMContentLoaded', function() {
    
    // Form elements
    const form = document.getElementById('enquiryForm');
    const submitBtn = form.querySelector('.btn-submit');
    const formSections = document.querySelectorAll('.form-section');
    
    // Initialize form enhancements
    initializeFormValidation();
    initializeProgressiveEnhancement();
    initializeAccessibilityFeatures();
    
    // Form validation with real-time feedback
    function initializeFormValidation() {
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            // Real-time validation
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid')) {
                    validateField(this);
                }
            });
        });
        
        // Form submission handling
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                submitForm();
            }
        });
    }
    
    function validateField(field) {
        const fieldGroup = field.closest('.form-floating') || field.closest('.form-check');
        let isValid = true;
        let errorMessage = '';
        
        // Remove existing validation classes
        field.classList.remove('is-valid', 'is-invalid');
        
        // Required field validation
        if (field.hasAttribute('required') && !field.value.trim()) {
            isValid = false;
            errorMessage = 'This field is required';
        }
        
        // Email validation
        if (field.type === 'email' && field.value.trim()) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(field.value)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }
        }
        
        // Phone validation
        if (field.type === 'tel' && field.value.trim()) {
            const phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(field.value.replace(/\D/g, ''))) {
                isValid = false;
                errorMessage = 'Please enter a valid 10-digit phone number';
            }
        }
        
        // Update field appearance
        field.classList.add(isValid ? 'is-valid' : 'is-invalid');
        
        // Handle error message display
        let errorDiv = fieldGroup.querySelector('.invalid-feedback');
        if (!isValid) {
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                fieldGroup.appendChild(errorDiv);
            }
            errorDiv.textContent = errorMessage;
        } else if (errorDiv) {
            errorDiv.remove();
        }
        
        return isValid;
    }
    
    function validateForm() {
        const inputs = form.querySelectorAll('input[required], select[required]');
        let isFormValid = true;
        
        inputs.forEach(input => {
            if (!validateField(input)) {
                isFormValid = false;
            }
        });
        
        return isFormValid;
    }
    
    function submitForm() {
        // Disable submit button and show loading state
        submitBtn.disabled = true;
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Submitting...';
        
        // Simulate form submission (replace with actual submission logic)
        setTimeout(() => {
            // Show success message
            showSuccessMessage();
            
            // Reset form
            form.reset();
            
            // Reset submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            
            // Remove validation classes
            form.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
                el.classList.remove('is-valid', 'is-invalid');
            });
            
        }, 2000);
    }
    
    function showSuccessMessage() {
        const successAlert = document.createElement('div');
        successAlert.className = 'alert alert-success alert-dismissible fade show position-fixed';
        successAlert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        successAlert.innerHTML = `
            <i class="fas fa-check-circle me-2"></i>
            <strong>Success!</strong> Your enquiry has been submitted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(successAlert);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (successAlert.parentNode) {
                successAlert.remove();
            }
        }, 5000);
    }
    
    // Progressive enhancement features
    function initializeProgressiveEnhancement() {
        // Auto-format phone numbers
        const phoneInputs = form.querySelectorAll('input[type="tel"]');
        phoneInputs.forEach(input => {
            input.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                if (value.length <= 10) {
                    value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
                    this.value = value;
                }
            });
        });
        
        // Auto-capitalize names
        const nameInputs = form.querySelectorAll('#yourName, #fathersName');
        nameInputs.forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
            });
        });
        
        // Course selection enhancement
        const courseSelect = form.querySelector('#selectCourse');
        if (courseSelect) {
            courseSelect.addEventListener('change', function() {
                if (this.value) {
                    // Add visual feedback
                    this.style.fontWeight = '600';
                    this.style.color = '#2c3e50';
                }
            });
        }
        
        // Dynamic academic section showing/hiding
        const regNoInput = form.querySelector('#regNo');
        if (regNoInput) {
            regNoInput.addEventListener('input', function() {
                const value = this.value.toLowerCase();
                const diplomaSection = document.querySelector('.academic-subsection:last-child');
                const twelfthSection = document.querySelector('.academic-subsection:first-child');
                
                if (value.includes('diploma')) {
                    diplomaSection.style.display = 'block';
                    twelfthSection.style.opacity = '0.6';
                } else {
                    diplomaSection.style.display = 'none';
                    twelfthSection.style.opacity = '1';
                }
            });
        }
    }
    
    // Accessibility features
    function initializeAccessibilityFeatures() {
        // Add ARIA labels for better screen reader support
        const requiredInputs = form.querySelectorAll('[required]');
        requiredInputs.forEach(input => {
            input.setAttribute('aria-required', 'true');
        });
        
        // Keyboard navigation enhancement
        const inputs = form.querySelectorAll('input, select, textarea, button');
        inputs.forEach((input, index) => {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && this.type !== 'textarea') {
                    e.preventDefault();
                    const nextInput = inputs[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                    } else if (this.type === 'submit' || this.classList.contains('btn-submit')) {
                        this.click();
                    }
                }
            });
        });
        
        // Focus management
        let focusedElement = null;
        document.addEventListener('focusin', function(e) {
            focusedElement = e.target;
        });
        
        // Skip to content functionality
        const skipLink = document.createElement('a');
        skipLink.href = '#enquiryForm';
        skipLink.textContent = 'Skip to main content';
        skipLink.className = 'visually-hidden-focusable btn btn-primary position-absolute';
        skipLink.style.cssText = 'top: 10px; left: 10px; z-index: 10000;';
        document.body.insertBefore(skipLink, document.body.firstChild);
    }
    
    // Smooth scroll to sections on validation errors
    function scrollToFirstError() {
        const firstError = form.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            firstError.focus();
        }
    }
    
    // Add smooth animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    formSections.forEach(section => {
        observer.observe(section);
    });
});