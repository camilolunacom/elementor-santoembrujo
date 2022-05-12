class EncyclopediaHandlerClass extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        terms: '.encyclopedia__term',
        definitions: '.encyclopedia__definition',
        currentDef: '.encyclopedia__definition--0',
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings('selectors');
    const elements = {
      $terms: this.$element.find(selectors.terms),
      $definitions: this.$element.find(selectors.definitions),
      $currentDef: this.$element.find(selectors.currentDef),
      $currentTerm: undefined,
    };

    return elements;
  }

  showTerm(e) {
    e.preventDefault();

    const currentElement = e.currentTarget;
    const breakpoint = window.matchMedia('(max-width: 767px)');

    if (this.elements.$currentTerm) {
      this.elements.$currentTerm.removeClass('encyclopedia__term--active');
    }

    this.elements.$currentTerm = jQuery(currentElement);

    this.elements.$currentTerm.addClass('encyclopedia__term--active');

    this.elements.$currentDef.fadeOut('fast', () => {
      this.elements.$currentDef = this.$element.find(
        `.encyclopedia__definition--${this.elements.$currentTerm.data('index')}`
      );
      this.elements.$currentDef.fadeIn('fast');
    });

    if (breakpoint.matches) {
      this.$element
        .find('.encyclopedia__col--2')
        .get(0)
        .scrollIntoView({ behavior: 'smooth' });
    }
  }

  onInit() {
    elementorModules.frontend.handlers.Base.prototype.onInit.apply(
      this,
      arguments
    );
  }

  bindEvents() {
    this.elements.$terms.on('click', this.showTerm.bind(this));
  }
}

jQuery(window).on('elementor/frontend/init', () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(EncyclopediaHandlerClass, {
      $element,
    });
  };

  elementorFrontend.hooks.addAction(
    'frontend/element_ready/encyclopedia.default',
    addHandler
  );
});
