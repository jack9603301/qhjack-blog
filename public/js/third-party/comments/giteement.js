/* global NexT, CONFIG */

document.addEventListener('page:loaded', () => {
  NexT.utils.loadComments('.giteement-container')
    .then(() => NexT.utils.getScript('https://giteement.oss-cn-beijing.aliyuncs.com/giteement.browser.js', {
      condition: window.Giteement
    }))
    .then(() => {
      var giteement = new Giteement({
        id: CONFIG.giteement.id,
        owner: CONFIG.giteement.giteeID,
        repo: CONFIG.giteement.repo,
        backcall_uri: CONFIG.giteement.redirect_uri,
        oauth_uri: CONFIG.giteement.oauth_uri,
        oauth: {
          client_id: CONFIG.giteement.gitment_oauth.client_id,
          client_secret: CONFIG.giteement.gitment_oauth.client_secret
        }
      });
      giteement.render(document.querySelector('.giteement-container'));
    });
});
