# ⛪️ n8n Sermon Automation Workflow

This repository documents the development of my **Sermon Automation Workflow** project, which uses n8n to automate various tasks for churches. These tasks include generating social media content, sermon transcripts, blog posts, etc — helping churches extend the reach of their sermon materials with less manual effort.

## 📎 Sermon Plugin Detector Workflow

This n8n workflow interacts with the **WordPress REST API** to identify which sermon plugin a church is using on their WordPress website. It starts by sending an HTTP request to the website, retrieving a list of active plugins from a [custom plugin](<https://github.com/charlottewolfe/n8n_sermon_automation_workflow/blob/main/plugin_list_plugin.php>) installed on the site.

From this list, the workflow branches into three tracks based on the detected plugin:
- **Sermon Manager**
- **Church Content**
- **Advanced Sermons**

Each branch can then be used to customize automation steps specific to that plugin's custom fields and taxonomies.

### 🔨 Possible Improvements
* Detecting plugins without installing a custom plugin (to make it more user-friendly for church website admins)
* Handling edge cases where a website uses multiple or none of the plugin options
* Automatically fetching custom field and taxonomy information via REST API
* Generalization to work with more websites (currently just connected to my Wordpress site)

## 📎 Deepgram Audio File Transcription Workflow
This n8n workflow obtains an audio file from a given sermon uplaoded to Wordpress, and sends the file to Deepgram to be transcripted. The last step of the workflow sends the transciption in an email so that it can be reviewed before continuing with the workflow.

Currently, the workflow requests a specific sermon from my wordpress staging site, downloads the associated audio file, and sends it to deepgram for transcription. It requires an additional HTTP request to obtain the post ID from Wordpress.

### 🔨 Possible Improvements
* Generalization to get a different sermon (not just the one from my website)
* Condensing the workflow so there aren't as many HTTP requests
* Utilizing Deepgram feautres to create a more accurate transcription (or using another AI transcription service)

## 📎 Current Workflow
This n8n workflow combines both my other workflows to transcribe a sermon recording as well as post a blog to my Wordpress site.

The workflow is triggered by a webhook that detects when a new audio file is added to the media library on a wordpress site through a custom plugin. Once the workflow is triggered, it requests to download the new media file. It then uses OpenAI's whisper model to transcribe and format the sermon. After adding the transcription to a new google doc, an email is sent to the user allowing them to approve or reject the new transcription. If rejected, the workflow waits for a set amount of time for the user to edit the transcript in the doc before continuing. 
Then, my Sermon Plugin Detector is used to standardize the different fields from the plugins (speaker, book, topic, etc.). Once those fields are edited, the transcipt and its attributes are used in an OpenAI request to create and format a relevant blog post, that is then posted to the Wordpress Site.

### 🔨 Possible Improvements
* Specify requests to OpenAI
* More efficient method of allowing the user to edit the transcription
