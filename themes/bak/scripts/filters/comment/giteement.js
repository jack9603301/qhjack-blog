/* global hexo */

'use strict';

const path = require('path');

// Add comment
hexo.extend.filter.register('theme_inject', injects => {
  const config = hexo.theme.config.giteement;
  if (!config.enable) return;

  injects.comment.raw('giteement', '<div class="comments giteement-container"></div>', {}, { cache: true });

  injects.bodyEnd.file('giteement', path.join(hexo.theme_dir, 'layout/_third-party/comments/giteement.njk'));
});
