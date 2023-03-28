# Template to use for release PRs from `develop` to `stable`

PR for tracking changes for the x.x.x release. Target release date: **DOW MONTH DAY YEAR**.

## Release checklist

### General

- [ ] Verify, and if necessary, update the allowed version ranges for various dependencies in the `composer.json` - PR #xxx
- [ ] Add changelog for the release - PR #xxx
    :pencil2: Remember to add a release link at the bottom!
- [ ] Update sniff list in `README` (if applicable) - PR #xxx.

### Release

- [ ] Merge this PR
- [ ] Make sure all CI builds are green.
- [ ] Tag and create a release (careful, GH defaults to `develop`!) & copy & paste the changelog to it.
    :pencil2: Check if anything from the link collection at the bottom of the changelog needs to be copied in!
- [ ] Make sure all CI builds are green.
- [ ] Close the milestone
- [ ] Open a new milestone for the next release
- [ ] If any open PRs/issues which were milestoned for this release did not make it into the release, update their milestone.
- [ ] Fast-forward `develop` to be equal to `stable`

### Publicize
- [ ] Tweet about the release.
