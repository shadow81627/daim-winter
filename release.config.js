module.exports = {
  branches: ['main'],
  generateNotes: {
    preset: 'angular',
  },

  plugins: [
    '@semantic-release/commit-analyzer',
    '@semantic-release/release-notes-generator',
    ['@semantic-release/changelog', { changelogTitle: '# Releases' }],
    '@semantic-release/npm',
    [
      '@semantic-release/git',
      {
        assets: [
            'CHANGELOG.md',
            'package.json',
            'package-lock.json',
            'composer.json',
            'composer.lock'
        ],
        message:
          'chore(release): ${nextRelease.version}\n\n${nextRelease.notes}',
      },
    ],
    '@semantic-release/github',
  ],
};
