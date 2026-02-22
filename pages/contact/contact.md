---
title: Contact Us
description: Get in touch with our team

form:
    name: contact-form
    action: /contact
    classes: contact-form

    fields:
        name:
          label: Your Name
          placeholder: John Doe
          type: text
          autofocus: true
          validate:
            required: true
            min: 2

        email:
          label: Email Address
          placeholder: john@example.com
          type: email
          validate:
            required: true

        subject:
          label: Subject
          type: select
          default: general
          options:
            general: General Inquiry
            support: Technical Support
            feedback: Feedback & Suggestions
            bug: Bug Report
            partnership: Partnership Opportunity

        message:
          label: Your Message
          placeholder: Tell us how we can help you...
          type: textarea
          rows: 6
          validate:
            required: true
            min: 10

        consent:
          label: I agree to the processing of my personal data
          type: checkbox
          validate:
            required: true

    buttons:
        submit:
          type: submit
          value: Send Message
          classes: submit-btn

    process:
        email:
            from: Helios <hello@helios.com>
            to: Helios <hello@helios.com>
            subject: "[Contact Form] {{ form.value.subject }}"
            body: "{% include 'forms/data.html.twig' %}"
        reset: true
        message: Thank you for your message! We'll get back to you within 24-48 hours.
        display: /contact
---
