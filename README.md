# ⛪️ n8n Sermon Automation Workflow

This repository documents the development of my **Sermon Automation Workflow** project, which uses n8n to automate various tasks for churches. These tasks include generating social media content, sermon transcripts, blog posts, etc — helping churches extend the reach of their sermon materials with less manual effort.

## 📎 Sermon Plugin Detector Workflow

This n8n workflow interacts with the **WordPress REST API** to identify which sermon plugin a church is using on their WordPress website. It starts by sending an HTTP request to the website, retrieving a list of active plugins from a [custom plugin](<https://github.com/charlottewolfe/n8n_sermon_automation_workflow/blob/main/plugin_list.zip>) installed on the site.

From this list, the workflow branches into three tracks based on the detected plugin:
- **Sermon Manager**
- **Church Content**
- **Advanced Sermons**

Each branch can then be used to customize automation steps specific to that plugin's custom fields and taxonomies.

### 🔨 Possible Improvements
* Detecting plugins without installing a custom plugin (to make it more user-friendly for church website admins)
* Handling edge cases where a website uses multiple or none of the plugin options
* Automatically fetching custom field and taxonomy information via REST API
