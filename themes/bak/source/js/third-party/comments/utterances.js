/* global NexT, CONFIG */

document.addEventListener('page:loaded', () => {
  if (!CONFIG.page.comments) return;

  if(CONFIG.utterances.overlay_comment_option && CONFIG.utterances.overlay_comment_option.utterances
    && CONFIG.utterances.overlay_comment_option.utterances.issue_term) {
      NexT.utils.loadComments('.utterances-container')
      .then(() => NexT.utils.getScript('https://utteranc.es/client.js', {
        attributes: {
          async       : true,
          crossOrigin : 'anonymous',
          'repo'      : CONFIG.utterances.repo,
          'issue-term': CONFIG.utterances.overlay_comment_option.utterances.issue_term,
          'theme'     : CONFIG.utterances.theme,
          'label'     : CONFIG.utterances.label
        },
        parentNode: document.querySelector('.utterances-container')
      }));
  } else if(CONFIG.utterances.overlay_comment_option && CONFIG.utterances.overlay_comment_option.utterances
    && CONFIG.utterances.overlay_comment_option.utterances.issue_number) {
    NexT.utils.loadComments('.utterances-container')
      .then(() => NexT.utils.getScript('https://utteranc.es/client.js', {
        attributes: {
          async       : true,
          crossOrigin : 'anonymous',
          'repo'      : CONFIG.utterances.repo,
          'issue-number': CONFIG.utterances.overlay_comment_option.utterances.issue_number,
          'theme'     : CONFIG.utterances.theme,
          'label'     : CONFIG.utterances.label
        },
        parentNode: document.querySelector('.utterances-container')
      }));
  } else {

    NexT.utils.loadComments('.utterances-container')
      .then(() => NexT.utils.getScript('https://utteranc.es/client.js', {
        attributes: {
          async       : true,
          crossOrigin : 'anonymous',
          'repo'      : CONFIG.utterances.repo,
          'issue-term': CONFIG.utterances.issue_term,
          'theme'     : CONFIG.utterances.theme,
          'label'     : CONFIG.utterances.label
        },
        parentNode: document.querySelector('.utterances-container')
      }));
  }
});
