// JavaScript para carrusel con movimiento continuo y soporte touch - carousel-touch.js

class ContinuousCarousel {
    constructor() {
        this.track = document.getElementById('carouselTrack');
        this.indicators = document.querySelectorAll('.carousel-indicator');
        this.cards = document.querySelectorAll('.carousel-article-card');
        this.container = document.querySelector('.carousel-main-container');
        
        if (this.cards.length <= 1) return;
        
        this.currentPosition = 0;
        this.cardWidth = 0;
        this.isAnimating = false;
        this.autoplayTimer = null;
        this.autoplaySpeed = 3000; // 3 segundos
        this.isPaused = false;
        
        // Touch/Swipe variables
        this.startX = 0;
        this.startY = 0;
        this.currentX = 0;
        this.currentY = 0;
        this.isDragging = false;
        this.threshold = 50;
        
        // Infinite scroll variables
        this.totalCards = this.cards.length;
        this.cloneCount = 3; // Número de clones en cada lado
        
        this.init();
    }
    
    init() {
        this.createInfiniteLoop();
        this.calculateCardWidth();
        this.bindEvents();
        this.setInitialPosition();
        this.startContinuousMovement();
    }
    
    createInfiniteLoop() {
        // Clonar las primeras y últimas tarjetas para crear el efecto infinito
        const firstCards = Array.from(this.cards).slice(0, this.cloneCount);
        const lastCards = Array.from(this.cards).slice(-this.cloneCount);
        
        // Agregar clones al final
        firstCards.forEach(card => {
            const clone = card.cloneNode(true);
            clone.classList.add('clone');
            this.track.appendChild(clone);
        });
        
        // Agregar clones al principio
        lastCards.reverse().forEach(card => {
            const clone = card.cloneNode(true);
            clone.classList.add('clone');
            this.track.insertBefore(clone, this.track.firstChild);
        });
        
        // Actualizar la referencia de tarjetas
        this.allCards = this.track.querySelectorAll('.carousel-article-card');
        this.currentPosition = this.cloneCount; // Empezar después de los clones iniciales
    }
    
    calculateCardWidth() {
        if (this.cards.length > 0) {
            const cardStyle = window.getComputedStyle(this.cards[0]);
            const cardMargin = parseInt(cardStyle.marginRight) || 10;
            this.cardWidth = this.cards[0].offsetWidth + cardMargin;
        }
    }
    
    setInitialPosition() {
        const translateX = this.currentPosition * this.cardWidth;
        this.track.style.transform = `translateX(-${translateX}px)`;
    }
    
    bindEvents() {
        // Indicator events
        this.indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                this.goToSlide(index);
            });
        });
        
        // Touch events
        this.track.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: false });
        this.track.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
        this.track.addEventListener('touchend', this.handleTouchEnd.bind(this), { passive: false });
        
        // Mouse events for desktop drag
        this.track.addEventListener('mousedown', this.handleMouseDown.bind(this));
        this.track.addEventListener('mousemove', this.handleMouseMove.bind(this));
        this.track.addEventListener('mouseup', this.handleMouseUp.bind(this));
        this.track.addEventListener('mouseleave', this.handleMouseUp.bind(this));
        
        // Prevent context menu on long press
        this.track.addEventListener('contextmenu', (e) => {
            if (this.isDragging) {
                e.preventDefault();
            }
        });
        
        // Pause/resume on hover
        if (this.container) {
            this.container.addEventListener('mouseenter', () => this.pauseMovement());
            this.container.addEventListener('mouseleave', () => this.resumeMovement());
        }
        
        // Handle window resize
        window.addEventListener('resize', () => {
            clearTimeout(this.resizeTimeout);
            this.resizeTimeout = setTimeout(() => {
                this.calculateCardWidth();
                this.updatePosition(false);
            }, 100);
        });
    }
    
    // Touch Events
    handleTouchStart(e) {
        if (this.isAnimating) return;
        
        this.startX = e.touches[0].clientX;
        this.startY = e.touches[0].clientY;
        this.isDragging = true;
        this.pauseMovement();
        
        this.track.classList.add('no-transition');
    }
    
    handleTouchMove(e) {
        if (!this.isDragging) return;
        
        this.currentX = e.touches[0].clientX;
        this.currentY = e.touches[0].clientY;
        
        const deltaX = this.currentX - this.startX;
        const deltaY = this.currentY - this.startY;
        
        if (Math.abs(deltaX) > Math.abs(deltaY)) {
            e.preventDefault();
            
            const currentTranslateX = -this.currentPosition * this.cardWidth;
            const newTranslateX = currentTranslateX + deltaX * 0.5;
            this.track.style.transform = `translateX(${newTranslateX}px)`;
        }
    }
    
    handleTouchEnd(e) {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        this.track.classList.remove('no-transition');
        
        const deltaX = this.currentX - this.startX;
        const deltaY = this.currentY - this.startY;
        
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > this.threshold) {
            if (deltaX > 0) {
                this.previousSlide();
            } else {
                this.nextSlide();
            }
        } else {
            this.updatePosition(true);
        }
        
        setTimeout(() => this.resumeMovement(), 1000);
    }
    
    // Mouse Events
    handleMouseDown(e) {
        if (this.isAnimating) return;
        
        this.startX = e.clientX;
        this.isDragging = true;
        this.pauseMovement();
        
        this.track.classList.add('no-transition');
        e.preventDefault();
    }
    
    handleMouseMove(e) {
        if (!this.isDragging) return;
        
        this.currentX = e.clientX;
        const deltaX = this.currentX - this.startX;
        
        const currentTranslateX = -this.currentPosition * this.cardWidth;
        const newTranslateX = currentTranslateX + deltaX * 0.5;
        this.track.style.transform = `translateX(${newTranslateX}px)`;
    }
    
    handleMouseUp(e) {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        this.track.classList.remove('no-transition');
        
        const deltaX = this.currentX - this.startX;
        
        if (Math.abs(deltaX) > this.threshold) {
            if (deltaX > 0) {
                this.previousSlide();
            } else {
                this.nextSlide();
            }
        } else {
            this.updatePosition(true);
        }
        
        setTimeout(() => this.resumeMovement(), 1000);
    }
    
    nextSlide() {
        if (this.isAnimating) return;
        
        this.currentPosition++;
        this.updatePosition(true);
        this.checkInfiniteLoop();
    }
    
    previousSlide() {
        if (this.isAnimating) return;
        
        this.currentPosition--;
        this.updatePosition(true);
        this.checkInfiniteLoop();
    }
    
    goToSlide(index) {
        if (this.isAnimating) return;
        
        this.pauseMovement();
        this.currentPosition = index + this.cloneCount;
        this.updatePosition(true);
        setTimeout(() => this.resumeMovement(), 2000);
    }
    
    updatePosition(animate = true) {
        if (animate) {
            this.isAnimating = true;
        }
        
        const translateX = this.currentPosition * this.cardWidth;
        this.track.style.transform = `translateX(-${translateX}px)`;
        
        this.updateIndicators();
        
        if (animate) {
            setTimeout(() => {
                this.isAnimating = false;
            }, 600);
        }
    }
    
    updateIndicators() {
        const realIndex = (this.currentPosition - this.cloneCount + this.totalCards) % this.totalCards;
        this.indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === realIndex);
        });
    }
    
    checkInfiniteLoop() {
        setTimeout(() => {
            // Si estamos al final de los clones, saltar al principio real
            if (this.currentPosition >= this.totalCards + this.cloneCount) {
                this.track.classList.add('no-transition');
                this.currentPosition = this.cloneCount;
                this.updatePosition(false);
                setTimeout(() => {
                    this.track.classList.remove('no-transition');
                }, 50);
            }
            
            // Si estamos al principio de los clones, saltar al final real
            if (this.currentPosition < this.cloneCount) {
                this.track.classList.add('no-transition');
                this.currentPosition = this.totalCards + this.cloneCount - 1;
                this.updatePosition(false);
                setTimeout(() => {
                    this.track.classList.remove('no-transition');
                }, 50);
            }
        }, 600);
    }
    
    startContinuousMovement() {
        this.autoplayTimer = setInterval(() => {
            if (!this.isDragging && !this.isPaused) {
                this.nextSlide();
            }
        }, this.autoplaySpeed);
    }
    
    pauseMovement() {
        this.isPaused = true;
    }
    
    resumeMovement() {
        this.isPaused = false;
    }
    
    stopMovement() {
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
            this.autoplayTimer = null;
        }
    }
}

// Initialize carousel when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ContinuousCarousel();
});