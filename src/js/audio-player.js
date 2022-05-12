class AudioPlayerHandlerClass extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        player: '.player',
        source: 'source',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    const elements = {
      $player: this.$element.find(selectors.player),
    };

    elements.$source = elements.$player.find(selectors.source);

    elements.$buttons = jQuery('.elementor-widget-icon-box[data-audio]');

    elements.$waBtn = jQuery('#ht-ctc-chat');

    return elements;
  }

  showPlayer() {
    if (this.playerHidden) {
      if (typeof this.elements.$waBtn !== 'undefined') {
        this.elements.$waBtn.fadeOut();
      }

      this.elements.$player.fadeIn();
      this.playerHidden = false;
    }
  }

  hidePlayer() {
    if (!this.playerHidden) {
      if (typeof this.elements.$waBtn !== 'undefined') {
        this.elements.$waBtn.fadeIn();
      }

      this.elements.$player.fadeOut();
      this.playerHidden = true;
    }
  }

  playTrack(e) {
    const button = e.currentTarget;
    const track = button.dataset.audio;

    this.showPlayer();

    this.elements.$player[0].pause();
    this.elements.$source[0].setAttribute(
      'src',
      `/wp-content/uploads/${track}`
    );
    this.elements.$player[0].load();
    this.elements.$player[0].play();
  }

  onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(
      this,
      arguments
    );

    this.playerHidden = true;

    this.elements.$player.on('ended', this.hidePlayer.bind(this));
  }

  bindEvents() {
    this.elements.$buttons.on('click', this.playTrack.bind(this));
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(AudioPlayerHandlerClass, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction(
    'frontend/element_ready/audio_player.default',
    addHandler
  );
});
