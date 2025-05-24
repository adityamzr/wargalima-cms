/**
 * Explore Grid Layout
 */

class ExploreGrid {
  constructor(containerSelector, itemSelector, options = {}) {
    // Default options
    this.options = {
      rowTargetHeight: 250,
      containerWidth: null,
      maxImagesPerRow: 6,
      minImagesPerRow: 4,
      itemGap: 0,
      ...options
    };

    this.container = document.querySelector(containerSelector);
    if (!this.container) return;

    this.items = this.container.querySelectorAll(itemSelector);
    if (!this.items.length) return;

    this.init();
  }

  /**
   * Initialize the grid layout
   */
  init() {
    this.container.style.display = 'flex';
    this.container.style.flexWrap = 'wrap';
    this.container.style.width = '100%';
    this.container.style.gap = '0px';

    this.options.containerWidth = this.container.offsetWidth;

    this.organizeItems();

    window.addEventListener('resize', this.debounce(() => {
      this.options.containerWidth = this.container.offsetWidth;
      this.organizeItems();
    }, 200));
  }

  /**
   * Organize items into rows
   */
  organizeItems() {
    const items = Array.from(this.items);
    const totalItems = items.length;
    const itemsPerRow = this.options.maxImagesPerRow;

    items.forEach(item => {
      item.style.width = '';
      item.style.height = '';
    });

    for (let i = 0; i < totalItems; i += itemsPerRow) {
      const rowItems = items.slice(i, Math.min(i + itemsPerRow, totalItems));
      if (rowItems.length === 0) continue;

      let rowRatio = 0;
      const rowItemsData = [];

      rowItems.forEach(item => {
        const img = item.querySelector('img');
        if (!img) return;

        const aspectRatio = this.getAspectRatio(img);
        rowRatio += aspectRatio;

        rowItemsData.push({
          element: item,
          aspectRatio: aspectRatio,
          img: img
        });
      });

      const isLastRow = i + itemsPerRow >= totalItems;
      this.layoutRow(rowItemsData, rowRatio, isLastRow);
    }
  }

  /**
   * Layout a row of items
   */
  layoutRow(row, rowRatio, isLastRow) {
    if (!row.length) return;

    let rowHeight;
    let rowWidth = this.options.containerWidth - (this.options.itemGap * (row.length - 1));

    if (isLastRow && row.length < this.options.maxImagesPerRow) {
      rowHeight = rowWidth / rowRatio;

      const maxHeight = this.options.rowTargetHeight * 1.5;
      if (rowHeight > maxHeight) {
        rowHeight = maxHeight;
      }
    } else {
      rowHeight = rowWidth / rowRatio;
    }

    let currentWidth = 0;

    row.forEach((item, index) => {
      let itemWidth = Math.floor(item.aspectRatio * rowHeight);

      if (index === row.length - 1) {
        itemWidth = rowWidth - currentWidth;
      }

      item.element.style.width = `${itemWidth}px`;
      item.element.style.height = `${rowHeight}px`;
      item.element.style.flexGrow = '0';
      item.element.style.flexShrink = '0';
      item.element.style.marginRight = index < row.length - 1 ? `${this.options.itemGap}px` : '0';

      item.img.style.width = '100%';
      item.img.style.height = '100%';
      item.img.style.objectFit = 'cover';

      currentWidth += itemWidth + this.options.itemGap;
    });
  }

  /**
   * Get the aspect ratio of an image
   * Tries multiple methods to determine the aspect ratio
   */
  getAspectRatio(img) {
    const parent = img.closest('[data-orientation]');
    if (parent) {
      const orientation = parent.dataset.orientation;

      if (orientation && orientation.toLowerCase() === 'landscape') {
        return 1.5;
      } else if (orientation && orientation.toLowerCase() === 'portrait') {
        return 0.75;
      }
    }

    let width = img.naturalWidth || img.width;
    let height = img.naturalHeight || img.height;

    if (width <= 1 || height <= 1) {
      const computedStyle = window.getComputedStyle(parent || img.parentElement);
      width = parseFloat(computedStyle.width);
      height = parseFloat(computedStyle.height);
    }

    if (width <= 1 || height <= 1) {
      return 1;
    }

    return width / height;
  }

  /**
   * Debounce function to limit how often a function is called
   */
  debounce(func, wait) {
    let timeout;
    return function() {
      const context = this;
      const args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        func.apply(context, args);
      }, wait);
    };
  }
}

document.addEventListener('DOMContentLoaded', function() {
  new ExploreGrid('#content-container', '.gallery-item', {
    rowTargetHeight: 250,
    minImagesPerRow: 5,
    maxImagesPerRow: 5,
    itemGap: 3
  });
});

window.addEventListener('load', function() {
  new ExploreGrid('#content-container', '.gallery-item', {
    rowTargetHeight: 250,
    minImagesPerRow: 5,
    maxImagesPerRow: 5,
    itemGap: 3
  });
});
